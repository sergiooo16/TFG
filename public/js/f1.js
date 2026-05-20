const TEAMS = {
  mclaren:     {name:'McLaren',       color:'#FF8000',engine:'Mercedes'},
  mercedes:    {name:'Mercedes',      color:'#00D2BE',engine:'Mercedes'},
  redbull:     {name:'Red Bull',      color:'#3671C6',engine:'Ford/RB'},
  ferrari:     {name:'Ferrari',       color:'#E8002D',engine:'Ferrari'},
  williams:    {name:'Williams',      color:'#64C4FF',engine:'Mercedes'},
  racingbulls: {name:'Racing Bulls',  color:'#6692FF',engine:'Ford/RB'},
  astonmartin: {name:'Aston Martin',  color:'#358C75',engine:'Honda'},
  haas:        {name:'Haas',          color:'#B0B4B8',engine:'Ferrari'},
  audi:        {name:'Audi',          color:'#C60016',engine:'Audi'},
  alpine:      {name:'Alpine',        color:'#FF87BC',engine:'Mercedes'},
  cadillac:    {name:'Cadillac',      color:'#4455DD',engine:'Ferrari'},
};

const F1_CDN = 'https://media.formula1.com/image/upload/f_auto,c_limit,q_75,w_320/content/dam/fom-website/drivers';
const DRIVERS = [
  {num:'1',  name:'Lando Norris',      flag:'🇬🇧',team:'mclaren',    ini:'LN',champion:true,img:`${F1_CDN}/L/LANNOR01_Lando_Norris/lannor01.png`},
  {num:'81', name:'Oscar Piastri',     flag:'🇦🇺',team:'mclaren',    ini:'OP',img:`${F1_CDN}/O/OSCPIA01_Oscar_Piastri/oscpia01.png`},
  {num:'63', name:'George Russell',    flag:'🇬🇧',team:'mercedes',   ini:'GR',img:`${F1_CDN}/G/GEORUS01_George_Russell/georus01.png`},
  {num:'12', name:'Kimi Antonelli',    flag:'🇮🇹',team:'mercedes',   ini:'KA',img:`${F1_CDN}/A/ANDANT01_Andrea_Kimi_Antonelli/andant01.png`},
  {num:'3',  name:'Max Verstappen',    flag:'🇳🇱',team:'redbull',    ini:'MV',img:`${F1_CDN}/M/MAXVER01_Max_Verstappen/maxver01.png`},
  {num:'6',  name:'Isack Hadjar',      flag:'🇫🇷',team:'redbull',    ini:'IH',img:`${F1_CDN}/I/ISAHAD01_Isack_Hadjar/isahad01.png`},
  {num:'16', name:'Charles Leclerc',   flag:'🇲🇨',team:'ferrari',    ini:'CL',img:`${F1_CDN}/C/CHALEC01_Charles_Leclerc/chalec01.png`},
  {num:'44', name:'Lewis Hamilton',    flag:'🇬🇧',team:'ferrari',    ini:'LH',img:`${F1_CDN}/L/LEWHAM01_Lewis_Hamilton/lewham01.png`},
  {num:'55', name:'Carlos Sainz',      flag:'🇪🇸',team:'williams',   ini:'CS',img:`${F1_CDN}/C/CARSAI01_Carlos_Sainz/carsai01.png`},
  {num:'23', name:'Alex Albon',        flag:'🇹🇭',team:'williams',   ini:'AA',img:`${F1_CDN}/A/ALEALB01_Alexander_Albon/alealb01.png`},
  {num:'41', name:'Arvid Lindblad',    flag:'🇬🇧',team:'racingbulls',ini:'AL',rookie:true,img:`${F1_CDN}/A/ARVLIN01_Arvid_Lindblad/arvlin01.png`},
  {num:'30', name:'Liam Lawson',       flag:'🇳🇿',team:'racingbulls',ini:'LL',img:`${F1_CDN}/L/LIALAW01_Liam_Lawson/lialaw01.png`},
  {num:'14', name:'Fernando Alonso',   flag:'🇪🇸',team:'astonmartin',ini:'FA',img:`${F1_CDN}/F/FERALO01_Fernando_Alonso/feralo01.png`},
  {num:'18', name:'Lance Stroll',      flag:'🇨🇦',team:'astonmartin',ini:'LS',img:`${F1_CDN}/L/LANSTR01_Lance_Stroll/lanstr01.png`},
  {num:'31', name:'Esteban Ocon',      flag:'🇫🇷',team:'haas',       ini:'EO',img:`${F1_CDN}/E/ESTEOC01_Esteban_Ocon/esteoc01.png`},
  {num:'87', name:'Oliver Bearman',    flag:'🇬🇧',team:'haas',       ini:'OB',img:`${F1_CDN}/O/OLIBEA01_Oliver_Bearman/olibea01.png`},
  {num:'27', name:'Nico Hülkenberg',   flag:'🇩🇪',team:'audi',       ini:'NH',img:`${F1_CDN}/N/NICHUL01_Nico_Hulkenberg/nichul01.png`},
  {num:'5',  name:'Gabriel Bortoleto', flag:'🇧🇷',team:'audi',       ini:'GB',img:`${F1_CDN}/G/GABBOR01_Gabriel_Bortoleto/gabbor01.png`},
  {num:'10', name:'Pierre Gasly',      flag:'🇫🇷',team:'alpine',     ini:'PG',img:`${F1_CDN}/P/PIEGAS01_Pierre_Gasly/piegas01.png`},
  {num:'43', name:'Franco Colapinto',  flag:'🇦🇷',team:'alpine',     ini:'FC',img:`${F1_CDN}/F/FRACOL01_Franco_Colapinto/fracol01.png`},
  {num:'11', name:'Sergio Pérez',      flag:'🇲🇽',team:'cadillac',   ini:'SP',img:`${F1_CDN}/S/SERPER01_Sergio_Perez/serper01.png`},
  {num:'77', name:'Valtteri Bottas',   flag:'🇫🇮',team:'cadillac',   ini:'VB',img:`${F1_CDN}/V/VALBOT01_Valtteri_Bottas/valbot01.png`},
];

const CIRCUIT_IMGS = {};

const FB_DRIVERS=[
  {pos:1,driver:'Kimi Antonelli',team:'Mercedes',pts:95,tk:'mercedes'},
  {pos:2,driver:'George Russell',team:'Mercedes',pts:82,tk:'mercedes'},
  {pos:3,driver:'Charles Leclerc',team:'Ferrari',pts:68,tk:'ferrari'},
  {pos:4,driver:'Lewis Hamilton',team:'Ferrari',pts:57,tk:'ferrari'},
  {pos:5,driver:'Oscar Piastri',team:'McLaren',pts:52,tk:'mclaren'},
  {pos:6,driver:'Lando Norris',team:'McLaren',pts:48,tk:'mclaren'},
  {pos:7,driver:'Max Verstappen',team:'Red Bull',pts:44,tk:'redbull'},
  {pos:8,driver:'Isack Hadjar',team:'Red Bull',pts:28,tk:'redbull'},
  {pos:9,driver:'Carlos Sainz',team:'Williams',pts:22,tk:'williams'},
  {pos:10,driver:'Oliver Bearman',team:'Haas',pts:19,tk:'haas'},
  {pos:11,driver:'Gabriel Bortoleto',team:'Audi',pts:16,tk:'audi'},
  {pos:12,driver:'Pierre Gasly',team:'Alpine',pts:13,tk:'alpine'},
  {pos:13,driver:'Arvid Lindblad',team:'Racing Bulls',pts:11,tk:'racingbulls'},
  {pos:14,driver:'Alex Albon',team:'Williams',pts:9,tk:'williams'},
  {pos:15,driver:'Esteban Ocon',team:'Haas',pts:7,tk:'haas'},
  {pos:16,driver:'Fernando Alonso',team:'Aston Martin',pts:6,tk:'astonmartin'},
  {pos:17,driver:'Liam Lawson',team:'Racing Bulls',pts:4,tk:'racingbulls'},
  {pos:18,driver:'Nico Hülkenberg',team:'Audi',pts:3,tk:'audi'},
  {pos:19,driver:'Franco Colapinto',team:'Alpine',pts:2,tk:'alpine'},
  {pos:20,driver:'Lance Stroll',team:'Aston Martin',pts:0,tk:'astonmartin'},
  {pos:21,driver:'Sergio Pérez',team:'Cadillac',pts:0,tk:'cadillac'},
  {pos:22,driver:'Valtteri Bottas',team:'Cadillac',pts:0,tk:'cadillac'},
];
const FB_CONSTR=[
  {pos:1,team:'Mercedes',pts:177,tk:'mercedes'},{pos:2,team:'Ferrari',pts:125,tk:'ferrari'},
  {pos:3,team:'McLaren',pts:100,tk:'mclaren'},{pos:4,team:'Red Bull',pts:72,tk:'redbull'},
  {pos:5,team:'Williams',pts:31,tk:'williams'},{pos:6,team:'Haas',pts:26,tk:'haas'},
  {pos:7,team:'Audi',pts:19,tk:'audi'},{pos:8,team:'Alpine',pts:15,tk:'alpine'},
  {pos:9,team:'Racing Bulls',pts:15,tk:'racingbulls'},{pos:10,team:'Aston Martin',pts:6,tk:'astonmartin'},
  {pos:11,team:'Cadillac',pts:0,tk:'cadillac'},
];

// ════════════════════════════════════════
// NAVBAR
// ════════════════════════════════════════
window.addEventListener('scroll',()=>document.getElementById('navbar').classList.toggle('scrolled',scrollY>60));
function toggleMenu(){const m=document.getElementById('mobileMenu');m.classList.toggle('hidden');m.classList.toggle('flex');}
function closeMenu(){const m=document.getElementById('mobileMenu');m.classList.add('hidden');m.classList.remove('flex');}
document.addEventListener('click',function(e){const w=document.getElementById('userMenuWrap');if(w&&!w.contains(e.target))document.getElementById('userDropdown')?.classList.add('hidden');});

// ════════════════════════════════════════
// COUNTDOWN — hardcodeado, pasa al siguiente automáticamente
// ════════════════════════════════════════
const RACE_DATES = [
  { name:'Gran Premio de Australia',    flag:'🇦🇺', short:'Australia',   date:'2026-03-15T05:00:00Z' },
  { name:'Gran Premio de China',        flag:'🇨🇳', short:'China',        date:'2026-03-22T07:00:00Z' },
  { name:'Gran Premio de Japón',        flag:'🇯🇵', short:'Japón',        date:'2026-03-29T05:00:00Z' },
  { name:'Gran Premio de Baréin',       flag:'🇧🇭', short:'Baréin',       date:'2026-04-19T15:00:00Z' },
  { name:'Gran Premio de Arabia Saudí', flag:'🇸🇦', short:'Arabia Saudí', date:'2026-04-26T17:00:00Z' },
  { name:'Gran Premio de Miami',        flag:'🇺🇸', short:'Miami',        date:'2026-05-10T19:00:00Z' },
  { name:'Gran Premio de Canadá',       flag:'🇨🇦', short:'Canadá',       date:'2026-05-24T20:00:00Z' },
  { name:'Gran Premio de Mónaco',       flag:'🇲🇨', short:'Mónaco',       date:'2026-06-07T13:00:00Z' },
  { name:'Gran Premio de España',       flag:'🇪🇸', short:'España',       date:'2026-06-14T13:00:00Z' },
  { name:'Gran Premio de Austria',      flag:'🇦🇹', short:'Austria',      date:'2026-06-28T13:00:00Z' },
  { name:'Gran Premio de Gran Bretaña', flag:'🇬🇧', short:'Gran Bretaña', date:'2026-07-05T14:00:00Z' },
  { name:'Gran Premio de Bélgica',      flag:'🇧🇪', short:'Bélgica',      date:'2026-07-26T13:00:00Z' },
  { name:'Gran Premio de Hungría',      flag:'🇭🇺', short:'Hungría',      date:'2026-08-02T13:00:00Z' },
  { name:'Gran Premio de Países Bajos', flag:'🇳🇱', short:'Países Bajos', date:'2026-08-30T13:00:00Z' },
  { name:'Gran Premio de Italia',       flag:'🇮🇹', short:'Italia',       date:'2026-09-06T13:00:00Z' },
  { name:'Gran Premio de Madrid',       flag:'🇪🇸', short:'Madrid',       date:'2026-09-13T13:00:00Z' },
  { name:'Gran Premio de Azerbaiyán',   flag:'🇦🇿', short:'Azerbaiyán',   date:'2026-09-27T11:00:00Z' },
  { name:'Gran Premio de Singapur',     flag:'🇸🇬', short:'Singapur',     date:'2026-10-04T12:00:00Z' },
  { name:'Gran Premio de EE.UU.',       flag:'🇺🇸', short:'EE.UU.',       date:'2026-10-18T19:00:00Z' },
  { name:'Gran Premio de México',       flag:'🇲🇽', short:'México',       date:'2026-10-25T20:00:00Z' },
  { name:'Gran Premio de Brasil',       flag:'🇧🇷', short:'Brasil',       date:'2026-11-08T17:00:00Z' },
  { name:'Gran Premio de Las Vegas',    flag:'🇺🇸', short:'Las Vegas',    date:'2026-11-21T06:00:00Z' },
  { name:'Gran Premio de Qatar',        flag:'🇶🇦', short:'Qatar',        date:'2026-11-29T15:00:00Z' },
  { name:'Gran Premio de Abu Dabi',     flag:'🇦🇪', short:'Abu Dabi',     date:'2026-12-06T13:00:00Z' },
];

function getNextRace() {
  const now = new Date();
  return RACE_DATES.find(r => new Date(r.date) > now) || RACE_DATES[RACE_DATES.length - 1];
}

function tick() {
  const next = getNextRace();
  const raceDate = new Date(next.date);
  const w = document.getElementById('countdown-wrap');
  if (!w) return;

  const nameEl = w.querySelector('.text-f1r');
  const dateEl = w.querySelector('.text-white.text-sm');
  if (nameEl) nameEl.textContent = `Próxima carrera · ${next.flag} ${next.short}`;
  if (dateEl) dateEl.textContent = raceDate.toLocaleDateString('es-ES',{day:'numeric',month:'long',year:'numeric'});

  const diff = raceDate - new Date();
  if (diff < 0) {
    w.innerHTML = '<div class="cd-box px-6 py-3 font-bc text-f1r font-700 tracking-[.1em]">🏁 EN MARCHA</div>';
    return;
  }
  const p = x => String(Math.floor(x)).padStart(2,'0');
  let d = diff;
  document.getElementById('cd-days').textContent  = p(d/864e5); d%=864e5;
  document.getElementById('cd-hours').textContent = p(d/36e5);  d%=36e5;
  document.getElementById('cd-mins').textContent  = p(d/6e4);
  document.getElementById('cd-secs').textContent  = p((d%6e4)/1e3);
}
tick(); setInterval(tick, 1000);

// ════════════════════════════════════════
// REVEAL
// ════════════════════════════════════════
const ro=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible');}),{threshold:.08});
function observeAll(){document.querySelectorAll('.reveal').forEach(el=>ro.observe(el));}

// ════════════════════════════════════════
// DRIVERS
// ════════════════════════════════════════
let activeTeam='all';
function renderDrivers(team='all',search=''){
  const g=document.getElementById('driversGrid');g.innerHTML='';
  const q=search.toLowerCase();let n=0;
  DRIVERS.forEach(d=>{
    const t=TEAMS[d.team];
    if(team!=='all'&&d.team!==team)return;
    if(q&&!d.name.toLowerCase().includes(q)&&!t.name.toLowerCase().includes(q))return;
    n++;
    const c=document.createElement('div');
    c.className='driver-card reveal';
    c.style.setProperty('--team-color',t.color);
    c.style.transitionDelay=`${(n-1)*.04}s`;
    c.innerHTML=`
      <div class="d-photo">
        <img src="${d.img}" alt="${d.name}" loading="lazy"
          onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
        <div class="d-fallback" style="color:${t.color}50"><span style="color:${t.color}">${d.ini}</span></div>
        <div class="d-num-bg" style="color:${t.color}">${d.num}</div>
        <div class="absolute top-3 left-3 flex gap-1 flex-wrap">
          ${d.champion?`<span class="font-bc font-700 text-xs text-yellow-400 bg-yellow-500/15 border border-yellow-500/25 px-2 py-0.5 rounded-full">👑 Campeón</span>`:''}
          ${d.rookie?`<span class="font-bc font-700 text-xs text-blue-400 bg-blue-500/12 border border-blue-400/25 px-2 py-0.5 rounded-full">★ Rookie</span>`:''}
        </div>
        <div class="d-grad absolute inset-x-0 bottom-0 h-16"></div>
      </div>
      <div class="p-4">
        <div class="flex items-start justify-between gap-2">
          <div>
            <div class="font-bc font-700 text-white text-lg tracking-wide leading-tight">${d.name}</div>
            <div class="text-gray-500 text-sm mt-0.5">${d.flag} &nbsp;·&nbsp; ${t.name}</div>
          </div>
          <div class="font-bebas text-2xl leading-none shrink-0 mt-0.5" style="color:${t.color}">#${d.num}</div>
        </div>
        <div class="mt-3 flex items-center gap-2">
          <div class="flex-1 h-px" style="background:${t.color}20"></div>
          <span class="font-bc text-xs tracking-[.08em]" style="color:${t.color}">${t.engine}</span>
        </div>
      </div>`;
    g.appendChild(c);ro.observe(c);
  });
  if(!n)g.innerHTML='<p class="col-span-full text-center py-12 text-gray-600 font-bc tracking-[.15em] text-sm uppercase">Sin resultados</p>';
}
function filterDrivers(){renderDrivers(activeTeam,document.getElementById('driverSearch').value);}
function setTeamFilter(btn,team){
  document.querySelectorAll('#teamFilterBtns .tab-btn').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');activeTeam=team;filterDrivers();
}

// ════════════════════════════════════════
// STANDINGS
// ════════════════════════════════════════
function tkFrom(id=''){
  id=id.toLowerCase();
  if(id.includes('mclaren'))return 'mclaren';
  if(id.includes('mercedes'))return 'mercedes';
  if(id.includes('red_bull')||id.includes('redbull'))return 'redbull';
  if(id.includes('ferrari'))return 'ferrari';
  if(id.includes('williams'))return 'williams';
  if(id.includes('alphatauri')||id.includes('racing_bulls')||id.includes('rb'))return 'racingbulls';
  if(id.includes('aston'))return 'astonmartin';
  if(id.includes('haas'))return 'haas';
  if(id.includes('sauber')||id.includes('audi'))return 'audi';
  if(id.includes('alpine')||id.includes('renault'))return 'alpine';
  if(id.includes('cadillac'))return 'cadillac';
  return 'mclaren';
}
function posIcon(p){return p===1?'<span class="font-bebas text-yellow-400 text-xl">①</span>':p===2?'<span class="font-bebas text-gray-300 text-xl">②</span>':p===3?'<span class="font-bebas text-orange-400 text-xl">③</span>':`<span class="font-bc font-700 text-gray-500">${p}</span>`;}

function renderDS(data){
  const max=data[0]?.pts||1;
  document.getElementById('driversTbody').innerHTML=data.map((s,i)=>{
    const t=TEAMS[s.tk||s.teamKey]||{color:'#888'};
    return`<tr class="s-row" style="animation-delay:${i*.04}s">
      <td class="pl-4 pr-2 py-3.5 rounded-l-xl">${posIcon(s.pos)}</td>
      <td class="py-3.5 pr-4">
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-full flex items-center justify-center font-bc font-700 text-xs shrink-0" style="background:${t.color}18;color:${t.color};border:1px solid ${t.color}38">${s.driver.split(' ').map(w=>w[0]).join('').slice(0,2)}</div>
          <div><div class="font-barlow font-600 text-white text-sm">${s.driver}</div><div class="pts-bg mt-1" style="width:88px"><div class="pts-bar" style="background:${t.color};width:${Math.round(s.pts/max*100)}%"></div></div></div>
        </div>
      </td>
      <td class="py-3.5 pr-4 hidden md:table-cell"><span class="font-bc text-xs tracking-[.06em]" style="color:${t.color}">${s.team}</span></td>
      <td class="py-3.5 pr-4 text-right rounded-r-xl"><span class="font-bc font-700 text-white">${s.pts}</span><span class="text-gray-600 text-xs ml-1">pts</span></td>
    </tr>`;
  }).join('');
}
function renderCS(data){
  const max=data[0]?.pts||1;
  document.getElementById('constructorsTbody').innerHTML=data.map((s,i)=>{
    const t=TEAMS[s.tk||s.teamKey]||{color:'#888'};
    return`<tr class="s-row" style="animation-delay:${i*.04}s">
      <td class="pl-4 pr-2 py-3.5 rounded-l-xl">${posIcon(s.pos)}</td>
      <td class="py-3.5 pr-4">
        <div class="flex items-center gap-3">
          <div class="w-1.5 h-8 rounded-full shrink-0" style="background:${t.color}"></div>
          <div><div class="font-bc font-700 text-white tracking-[.04em]">${s.team}</div><div class="pts-bg mt-1" style="width:120px"><div class="pts-bar" style="background:${t.color};width:${Math.round(s.pts/max*100)}%"></div></div></div>
        </div>
      </td>
      <td class="py-3.5 pr-4 text-right rounded-r-xl"><span class="font-bc font-700 text-white">${s.pts}</span><span class="text-gray-600 text-xs ml-1">pts</span></td>
    </tr>`;
  }).join('');
}
async function loadStandings(){
  let dD=null,cD=null;
  try{
    const[dr,cr]=await Promise.all([fetch('https://api.jolpi.ca/ergast/f1/current/driverStandings.json'),fetch('https://api.jolpi.ca/ergast/f1/current/constructorStandings.json')]);
    if(dr.ok){const j=await dr.json();const l=j?.MRData?.StandingsTable?.StandingsLists?.[0]?.DriverStandings;if(l?.length)dD=l.map(s=>({pos:+s.position,driver:`${s.Driver.givenName} ${s.Driver.familyName}`,team:s.Constructors?.[0]?.name||'',pts:+s.points,tk:tkFrom(s.Constructors?.[0]?.constructorId||'')}));}
    if(cr.ok){const j=await cr.json();const l=j?.MRData?.StandingsTable?.StandingsLists?.[0]?.ConstructorStandings;if(l?.length)cD=l.map(s=>({pos:+s.position,team:s.Constructor.name,pts:+s.points,tk:tkFrom(s.Constructor.constructorId)}));}
  }catch(_){}
  renderDS(dD||FB_DRIVERS);renderCS(cD||FB_CONSTR);
  document.getElementById('s-loading').classList.add('hidden');
  document.getElementById('driversTable').classList.remove('hidden');
}
function switchTab(tab,btn){
  document.querySelectorAll('#standings .tab-btn').forEach(b=>b.classList.remove('active'));btn.classList.add('active');
  document.getElementById('s-driver').classList.toggle('hidden',tab!=='drivers');
  document.getElementById('s-constructor').classList.toggle('hidden',tab!=='constructors');
}

// ════════════════════════════════════════
// CIRCUITS
// ════════════════════════════════════════
function renderCircuits(){
  const g=document.getElementById('circuitsGrid');
  CIRCUITS.forEach((c,i)=>{
    const pc=c.st==='done'?'pill-done':c.st==='next'?'pill-next':'pill-upcoming';
    const pt=c.st==='done'?'Finalizado':c.st==='next'?'Próxima':'Próximamente';
    const el=document.createElement('div');
    el.className='circuit-card reveal';
    el.style.transitionDelay=`${i*.04}s`;
    if(c.st!=='done') el.onclick=()=>openModal(c);
    el.innerHTML=`
      <div class="c-photo">
        <div class="c-photo-fallback" id="cfb-${c.id}" style="display:none;position:absolute;inset:0;align-items:center;justify-content:center;flex-direction:column;gap:4px;background:linear-gradient(135deg,#0d0d14,#1a1a20);">
          <span style="font-size:2.6rem;filter:drop-shadow(0 2px 6px rgba(0,0,0,.6))">${c.flag}</span>
          <span style="font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:.65rem;letter-spacing:.14em;text-transform:uppercase;color:#444">${c.city}</span>
        </div>
        <img src="${c.img}" alt="${c.name}" loading="lazy"
          onerror="this.style.display='none';var f=document.getElementById('cfb-${c.id}');if(f){f.style.display='flex';}">
        <div class="c-overlay"></div>
        <div class="absolute top-3 left-3 font-bc font-700 text-xs tracking-[.12em] text-gray-500 uppercase">R${c.r}</div>
        ${c.sprint?'<div class="absolute top-3 right-3"><span class="s-pill pill-sprint">Sprint</span></div>':''}
      </div>
      <div class="p-4">
        <div class="flex items-start justify-between gap-2 mb-1.5">
          <div class="font-bc font-700 text-white text-base tracking-wide leading-tight">${c.flag} ${c.short}</div>
          <span class="s-pill ${pc} shrink-0">${pt}</span>
        </div>
        <div class="font-barlow text-gray-500 text-xs mb-0.5">${c.circuit}</div>
        <div class="font-bc text-gray-600 text-xs tracking-[.12em] uppercase mb-4">${c.date}</div>
        <button class="w-full py-2.5 rounded-lg font-bc font-700 text-sm tracking-[.1em] uppercase transition-all border ${c.st==='done'?'border-f1border text-gray-700 cursor-not-allowed':'border-f1r/40 text-f1r hover:bg-f1r hover:text-white'}">
          ${c.st==='done'?'Carrera Finalizada':'Comprar Entradas'}
        </button>
      </div>`;
    g.appendChild(el);ro.observe(el);
  });
}

// ════════════════════════════════════════
// MODAL ENTRADAS
// ════════════════════════════════════════
let curC=null,selTier='grand',qty=1;
const TIERS=[
  {id:'ga',     icon:'🏁',name:'General',   price:'ga',  desc:'Acceso general a todas las zonas de pie. Sin asiento asignado.'},
  {id:'grand',  icon:'💺',name:'Grandstand',price:'grand',desc:'Asiento numerado en tribuna cubierta con vista directa a la pista.'},
  {id:'vip',    icon:'⭐',name:'VIP Club',  price:'vip', desc:'Hospitalidad premium, catering gourmet y acceso exclusivo zona pit.'},
  {id:'premium',icon:'🏆',name:'Paddock',   price:'p',   desc:'Paddock Club: garajes, drivers parade y hospitalidad máxima F1.'},
];
function openModal(c){
  curC=c;selTier='grand';qty=1;
  document.getElementById('modal-box').innerHTML=modalHTML(c);
  document.getElementById('modal-overlay').classList.add('open');
  document.body.style.overflow='hidden';
  selectTier('grand');
}
function modalHTML(c){
  return`
    <div class="flex items-start justify-between mb-5">
      <div>
        <div class="font-bc font-700 text-f1r text-xs tracking-[.18em] uppercase mb-1">Ronda ${c.r} · ${c.date}</div>
        <h3 class="font-bebas text-white text-2xl md:text-3xl tracking-wide leading-tight">${c.name}</h3>
        <p class="font-barlow text-gray-500 text-sm mt-1">${c.circuit} · ${c.city} ${c.flag}</p>
      </div>
      <button onclick="closeModal()" class="shrink-0 ml-4 w-9 h-9 rounded-full border border-f1border flex items-center justify-center text-gray-500 hover:text-f1r hover:border-f1r transition-all text-sm">✕</button>
    </div>
    <div class="c-photo rounded-xl mb-5" style="height:130px">
      <div style="display:none;position:absolute;inset:0;align-items:center;justify-content:center;background:linear-gradient(135deg,#0d0d14,#1a1a20);border-radius:12px;" id="mfb-${c.id}">
        <span style="font-size:3rem">${c.flag}</span>
      </div>
      <img src="${c.img}" alt="${c.name}" style="width:100%;height:100%;object-fit:cover;filter:brightness(.55)"
        onerror="this.style.display='none';var f=document.getElementById('mfb-${c.id}');if(f){f.style.display='flex';}">
      <div class="c-overlay rounded-xl"></div>
    </div>
    <p class="font-bc font-600 text-xs tracking-[.15em] text-gray-500 uppercase mb-3">Elige tu entrada</p>
    <div class="grid grid-cols-2 gap-3 mb-5">
      ${TIERS.map(ti=>`<div id="tier-${ti.id}" class="tier-card" onclick="selectTier('${ti.id}')">
        <div class="flex items-center gap-2 mb-1.5">
          <span class="text-lg">${ti.icon}</span>
          <div>
            <div class="font-bc font-700 text-white text-sm tracking-[.04em]">${ti.name}</div>
            <div class="font-bebas text-f1r text-lg tracking-wide">€${c.t[ti.price]}</div>
          </div>
        </div>
        <p class="font-barlow text-gray-600 text-xs leading-relaxed">${ti.desc}</p>
      </div>`).join('')}
    </div>
    <div class="flex items-center gap-4 mb-5">
      <span class="font-bc font-600 text-xs tracking-[.15em] text-gray-500 uppercase">Cantidad</span>
      <div class="flex items-center gap-3">
        <button onclick="changeQty(-1)" class="w-9 h-9 rounded-lg border border-f1border font-bc font-700 text-gray-400 hover:text-f1r hover:border-f1r transition-all">−</button>
        <span id="m-qty" class="font-bc font-700 text-white w-5 text-center">${qty}</span>
        <button onclick="changeQty(1)"  class="w-9 h-9 rounded-lg border border-f1border font-bc font-700 text-gray-400 hover:text-f1r hover:border-f1r transition-all">+</button>
      </div>
    </div>
    <div class="flex items-center justify-between border-t border-f1border pt-5">
      <div>
        <div class="font-bc text-xs text-gray-600 tracking-[.15em] uppercase">Total</div>
        <div id="m-total" class="font-bebas text-f1g text-3xl tracking-wide">€${c.t.grand}</div>
      </div>
      <button class="btn-buy" onclick="buyNow()">Comprar Ahora →</button>
    </div>`;
}
function selectTier(id){
  selTier=id;
  document.querySelectorAll('.tier-card').forEach(el=>el.classList.remove('selected'));
  const el=document.getElementById('tier-'+id);if(el)el.classList.add('selected');
  updateTotal();
}
function changeQty(d){qty=Math.max(1,Math.min(10,qty+d));const el=document.getElementById('m-qty');if(el)el.textContent=qty;updateTotal();}
function updateTotal(){const el=document.getElementById('m-total');const tier=TIERS.find(t=>t.id===selTier);if(el&&curC&&tier)el.textContent=`€${(curC.t[tier.price]*qty).toLocaleString('es-ES')}`;}
function buyNow(){
  const tier=TIERS.find(t=>t.id===selTier);
  document.getElementById('modal-box').innerHTML=`
    <div class="text-center py-10">
      <div class="text-5xl mb-5">🏆</div>
      <div class="font-bebas text-white text-3xl tracking-wide mb-2">¡Pedido Confirmado!</div>
      <p class="font-barlow text-gray-400 mb-6">${curC.name} · ${tier.name} · ${qty} entrada${qty>1?'s':''}</p>
      <div class="inline-block border border-f1border rounded-xl px-8 py-4 mb-6">
        <div class="font-bebas text-f1g text-4xl tracking-wide">€${(curC.t[tier.price]*qty).toLocaleString('es-ES')}</div>
        <div class="font-bc text-xs text-gray-600 tracking-[.15em] uppercase mt-1">Total pagado</div>
      </div>
      <p class="font-barlow text-gray-600 text-sm mb-8">Recibirás las entradas por email en formato PDF.</p>
      <button class="btn-buy" onclick="closeModal()">Volver al Calendario</button>
    </div>`;
  qty=1;
}
function closeModal(){document.getElementById('modal-overlay').classList.remove('open');document.body.style.overflow='';qty=1;}
function overlayClose(e){if(e.target===document.getElementById('modal-overlay'))closeModal();}

// ════════════════════════════════════════
// NOTICIAS
// ════════════════════════════════════════
const NEWS_BG    = ['#0d0812','#080d14','#0d0808','#080d0d','#0d0d08','#10080d'];
const NEWS_ICONS = ['🏎️','🏁','⚙️','🏆','🔧','📡'];

async function loadNews() {
  try {
    const ctrl  = new AbortController();
    const timer = setTimeout(() => ctrl.abort(), 15000);
    const r = await fetch(API_NEWS_URL, { signal: ctrl.signal });
    clearTimeout(timer);
    if (!r.ok) throw new Error();
    const articles = await r.json();
    renderNews(articles);
  } catch(_) {
    document.getElementById('newsGrid').innerHTML =
      '<p class="col-span-full text-center py-12 text-gray-600 font-bc tracking-[.15em] text-sm uppercase">No se pudieron cargar las noticias. Inténtalo más tarde.</p>';
  }
}

function renderNews(articles) {
  const grid = document.getElementById('newsGrid');
  grid.innerHTML = '';
  articles.forEach((a, i) => {
    const card = document.createElement('a');
    card.href   = a.url;
    card.target = '_blank';
    card.rel    = 'noopener noreferrer';
    card.className = 'news-card reveal';
    card.style.transitionDelay = `${i * .06}s`;
    card.innerHTML = `
      <div class="news-img-wrap">
        <div class="news-img-bg" style="background:${NEWS_BG[i%6]};color:#1a1a22;">${NEWS_ICONS[i%6]}</div>
        ${a.img ? `<img src="${a.img}" alt="${a.title.replace(/"/g,"'")}" loading="lazy" onerror="this.style.display='none'">` : ''}
        <div class="news-img-overlay"></div>
      </div>
      <div class="p-4">
        <div class="flex items-center justify-between mb-3">
          <span class="news-source-badge">${a.source}</span>
          <span class="news-date-txt">${a.date}</span>
        </div>
        <h3 class="font-bc font-700 text-white text-base leading-snug mb-2" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">${a.title}</h3>
        <p class="font-barlow text-gray-500 text-xs leading-relaxed" style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden">${a.excerpt}</p>
        <div class="mt-4 flex items-center gap-1 font-bc font-700 text-xs tracking-wide" style="color:var(--red)">Leer más <span>→</span></div>
      </div>`;
    grid.appendChild(card);
    ro.observe(card);
  });
}

// ════════════════════════════════════════
// RUMORES
// ════════════════════════════════════════
async function loadRumors() {
  try {
    const r = await fetch(API_RUMORS_URL);
    if (!r.ok) throw new Error();
    const data = await r.json();
    if (data.length) {
      renderRumors(data);
    } else {
      document.getElementById('rumorsGrid').innerHTML =
        '<p class="col-span-full text-center py-12 text-gray-600 font-bc tracking-[.15em] text-sm uppercase">Sin rumores disponibles.</p>';
    }
  } catch(_) {}
}

function renderRumors(rumors) {
  const grid = document.getElementById('rumorsGrid');
  grid.innerHTML = '';
  rumors.forEach((r, i) => {
    const card = document.createElement('div');
    card.className = 'rumor-card reveal';
    card.style.setProperty('--rc', r.color);
    card.style.transitionDelay = `${i * .06}s`;
    card.innerHTML = `
      <div class="flex items-start justify-between gap-3 mb-3">
        <div>
          <div class="font-bebas text-white text-xl leading-none tracking-wide">${r.driver}</div>
          <div class="font-bc font-700 text-xs tracking-[.08em] mt-0.5" style="color:${r.color}">${r.team}</div>
        </div>
        <span class="rumor-tag ${r.tagCls} shrink-0">${r.tag}</span>
      </div>
      <p class="font-barlow text-gray-400 text-sm leading-relaxed mb-4">${r.text}</p>
      <div class="mb-3">
        <div class="flex items-center justify-between mb-1">
          <span class="font-bc text-xs text-gray-600 tracking-[.1em] uppercase">Credibilidad</span>
          <span class="font-bebas text-base" style="color:${r.credColor}">${r.cred}%</span>
        </div>
        <div class="cred-bar"><div class="cred-fill" style="background:${r.credColor};width:${r.cred}%"></div></div>
      </div>
      <div class="flex items-center justify-between pt-3 border-t border-f1border">
        <span class="font-bc text-xs text-gray-600">${r.source}</span>
        <span class="font-bc text-xs text-gray-600">${r.date}</span>
      </div>`;
    grid.appendChild(card);
    ro.observe(card);
  });
}

// ════════════════════════════════════════
// INIT
// ════════════════════════════════════════
document.addEventListener('DOMContentLoaded',()=>{
  renderDrivers();renderCircuits();loadStandings();loadNews();loadRumors();observeAll();
});
