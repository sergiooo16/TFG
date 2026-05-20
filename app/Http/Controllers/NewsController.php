<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Noticia;

class NewsController extends Controller
{
    private array $sources = [
        ['url' => 'https://www.marca.com/rss/motor/formula1.xml',       'name' => 'marca.com',         'lang' => 'es'],
        ['url' => 'https://as.com/rss/tags/formula_1.xml',              'name' => 'as.com',            'lang' => 'es'],
        ['url' => 'https://www.mundodeportivo.com/motor/formula-1/rss', 'name' => 'mundodeportivo.com','lang' => 'es'],
        ['url' => 'https://es.motorsport.com/rss/f1/news/',             'name' => 'motorsport.com',    'lang' => 'es'],
        ['url' => 'https://www.sport.es/es/rss/formula1.xml',           'name' => 'sport.es',          'lang' => 'es'],
        ['url' => 'https://www.autosport.com/rss/f1/news/',             'name' => 'autosport.com',     'lang' => 'en'],
        ['url' => 'https://www.racefans.net/feed/',                     'name' => 'racefans.net',      'lang' => 'en'],
    ];

    public function index(): JsonResponse
    {
        // 1. Noticias propias del admin (siempre van primero)
        $adminNews = Noticia::where('activo', 1)
            ->orderByDesc('id')
            ->get()
            ->map(fn($n) => [
                'title'   => $n->titulo,
                'source'  => $n->fuente,
                'date'    => $n->fecha,
                'excerpt' => $n->extracto,
                'img'     => $n->imagen ?? '',
                'url'     => $n->url ?? '#',
            ])
            ->toArray();

        // 2. Noticias RSS (desde caché si existe)
        $rssNews = Cache::get('f1_news_es', []);

        if (empty($rssNews)) {
            $rssNews = $this->fetchFromRSS();
            if (count($rssNews) >= 3) {
                Cache::put('f1_news_es', $rssNews, now()->addHours(24));
            }
        }

        // 3. Mezclar: primero las del admin, luego RSS hasta completar 6
        $result = $adminNews;
        foreach ($rssNews as $item) {
            if (count($result) >= 6) break;
            $result[] = $item;
        }

        return response()->json(array_slice($result, 0, 6));
    }

    private function fetchFromRSS(): array
    {
        $esArticles = [];
        $enArticles = [];

        foreach ($this->sources as $src) {
            if (count($esArticles) >= 6) break;
            if ($src['lang'] === 'en' && count($esArticles) >= 3) continue;

            try {
                $response = Http::timeout(5)
                    ->withoutVerifying()
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/124.0 Safari/537.36',
                        'Accept'     => 'application/rss+xml, application/xml, text/xml, */*',
                    ])
                    ->get($src['url']);

                if (!$response->successful()) continue;

                $xml = $response->body();
                if (empty($xml) || !str_contains($xml, '<item')) continue;

                libxml_use_internal_errors(true);
                $doc = simplexml_load_string($xml);
                libxml_clear_errors();

                if (!$doc || !isset($doc->channel->item)) continue;

                foreach ($doc->channel->item as $item) {
                    $img       = $this->extractImage($item);
                    $timestamp = @strtotime((string) $item->pubDate);

                    $article = [
                        'title'   => html_entity_decode(strip_tags((string) $item->title), ENT_QUOTES, 'UTF-8'),
                        'source'  => $src['name'],
                        'date'    => $timestamp ? $this->formatDateEs($timestamp) : '',
                        'excerpt' => mb_substr(strip_tags(html_entity_decode((string) $item->description, ENT_QUOTES, 'UTF-8')), 0, 130) . '…',
                        'img'     => $img,
                        'url'     => trim((string) $item->link),
                    ];

                    if ($src['lang'] === 'es') {
                        $esArticles[] = $article;
                        if (count($esArticles) >= 6) break;
                    } else {
                        $enArticles[] = $article;
                    }
                }
            } catch (\Throwable) {
                continue;
            }
        }

        $result = $esArticles;
        if (count($result) < 6) {
            $result = array_merge($result, array_slice($enArticles, 0, 6 - count($result)));
        }

        return array_slice($result, 0, 6);
    }

    private function formatDateEs(int $timestamp): string
    {
        $meses = ['','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
        return date('j', $timestamp) . ' ' . $meses[(int)date('n', $timestamp)] . ' ' . date('Y', $timestamp);
    }

    private function extractImage(\SimpleXMLElement $item): string
    {
        if (isset($item->enclosure)) {
            foreach ($item->enclosure as $enc) {
                $type = (string)($enc['type'] ?? '');
                $url  = (string)($enc['url']  ?? '');
                if ($url && (str_starts_with($type, 'image') || preg_match('/\.(jpg|jpeg|png|webp|gif)/i', $url))) {
                    return $url;
                }
            }
        }
        $namespaces = $item->getNamespaces(true);
        if (isset($namespaces['media'])) {
            $media = $item->children($namespaces['media']);
            foreach (['content', 'thumbnail'] as $tag) {
                if (isset($media->$tag)) {
                    foreach ($media->$tag as $el) {
                        $url = (string)($el->attributes()->url ?? $el['url'] ?? '');
                        if ($url) return $url;
                    }
                }
            }
        }
        $desc = html_entity_decode((string)$item->description, ENT_QUOTES, 'UTF-8');
        if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $desc, $m)) return $m[1];
        if (isset($namespaces['content'])) {
            $content = $item->children($namespaces['content']);
            if (isset($content->encoded)) {
                $enc = html_entity_decode((string)$content->encoded, ENT_QUOTES, 'UTF-8');
                if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $enc, $m)) return $m[1];
            }
        }
        return '';
    }
}
