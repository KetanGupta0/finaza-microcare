(function(){
  /* ===== Launch target: Diwali, 8 Nov 2026, 00:00 IST ===== */
  var TARGET = new Date(document.body.dataset.launchAt).getTime();

  var els = {d:document.getElementById('d'),h:document.getElementById('h'),m:document.getElementById('m'),s:document.getElementById('s')};
  var prev = {};
  function pad(n){return n<10?'0'+n:''+n}
  function setVal(k,v){
    if(prev[k]===v) return;
    prev[k]=v; var el=els[k]; el.textContent=v;
    el.classList.remove('tick'); void el.offsetWidth; el.classList.add('tick');
  }
  var timer;
  function update(){
    var diff = TARGET - Date.now();
    if(diff<=0){
      clearInterval(timer);
      document.body.classList.add('is-live');
      if(window.__burst) window.__burst(true);
      return;
    }
    var s=Math.floor(diff/1000);
    setVal('d', pad(Math.floor(s/86400)));
    setVal('h', pad(Math.floor(s%86400/3600)));
    setVal('m', pad(Math.floor(s%3600/60)));
    setVal('s', pad(s%60));
  }
  update(); timer=setInterval(update,1000);
  document.getElementById('yr').textContent = new Date().getFullYear();

  /* ===== Mandala petals ===== */
  function petals(id,count,r1,r2){
    var g=document.getElementById(id), ns='http://www.w3.org/2000/svg';
    for(var i=0;i<count;i++){
      var p=document.createElementNS(ns,'path');
      p.setAttribute('d','M100 '+(100-r1)+' Q'+(100+9)+' '+(100-(r1+r2)/2)+' 100 '+(100-r2)+' Q'+(100-9)+' '+(100-(r1+r2)/2)+' 100 '+(100-r1));
      p.setAttribute('transform','rotate('+(360/count*i)+' 100 100)');
      g.appendChild(p);
    }
  }
  petals('mand',16,34,60); petals('mand',24,60,80); petals('mand',12,14,34);
  petals('mand2',20,20,48); petals('mand2',30,48,72);

  /* ===== Lanterns ===== */
  var L=document.getElementById('lanterns');
  var cfg=[{x:6,len:70,s:.9,d:0},{x:18,len:120,s:.7,d:.8,sm:1},{x:82,len:110,s:.75,d:.4,sm:1},{x:94,len:60,s:.95,d:1.2}];
  cfg.forEach(function(c,i){
    var w=document.createElement('div'); w.className='lantern'+(c.sm?' hide-sm':'');
    w.style.left=c.x+'%'; w.style.animationDelay=c.d+'s';
    w.innerHTML='<div class="string" style="height:'+c.len+'px"></div>'+
      '<svg width="'+(44*c.s)+'" height="'+(70*c.s)+'" viewBox="0 0 44 70"><defs><radialGradient id="lg'+i+'" cx="50%" cy="50%" r="60%"><stop offset="0" stop-color="#fff2b8"/><stop offset=".45" stop-color="#ffb340"/><stop offset="1" stop-color="#c2410c"/></radialGradient></defs>'+
      '<rect x="15" y="0" width="14" height="6" rx="2" fill="#b8862c"/><path d="M8 8 Q22 2 36 8 Q44 32 36 56 Q22 62 8 56 Q0 32 8 8z" fill="url(#lg'+i+')"/>'+
      '<path d="M22 6 V58 M13 9 Q8 32 13 55 M31 9 Q36 32 31 55" stroke="rgba(120,40,10,.45)" stroke-width="1" fill="none"/>'+
      '<rect x="15" y="57" width="14" height="5" rx="2" fill="#b8862c"/><path d="M18 62 L16 70 M22 62 V70 M26 62 L28 70" stroke="#ffd77a" stroke-width="1.2"/></svg>';
    L.appendChild(w);
  });

  /* ===== Canvas: twinkling stars, rising embers, fireworks ===== */
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var cv=document.getElementById('sky'), ctx=cv.getContext('2d'), W,H,DPR;
  var stars=[], embers=[], sparks=[];
  function resize(){
    DPR=Math.min(window.devicePixelRatio||1,2);
    W=cv.clientWidth; H=cv.clientHeight;
    cv.width=W*DPR; cv.height=H*DPR; ctx.setTransform(DPR,0,0,DPR,0,0);
    var n=Math.round(W*H/9000); stars=[];
    for(var i=0;i<n;i++) stars.push({x:Math.random()*W,y:Math.random()*H*.75,r:Math.random()*1.3+.2,p:Math.random()*Math.PI*2,sp:.01+Math.random()*.03});
  }
  resize(); window.addEventListener('resize',resize);

  function addEmber(){
    embers.push({x:Math.random()*W,y:H+10,vy:-(.3+Math.random()*.9),vx:(Math.random()-.5)*.3,r:Math.random()*2+.6,life:1,hue:30+Math.random()*20});
  }
  var palette=['#ffd77a','#ffb340','#ff7a3d','#ff5d8f','#c084fc','#fff1c7','#7dd3fc'];
  function firework(x,y){
    var col=palette[Math.floor(Math.random()*palette.length)], n=60+Math.floor(Math.random()*40);
    for(var i=0;i<n;i++){
      var a=Math.PI*2*i/n, sp=1.2+Math.random()*2.8;
      sparks.push({x:x,y:y,vx:Math.cos(a)*sp,vy:Math.sin(a)*sp,life:1,decay:.008+Math.random()*.012,col:col,r:1.4+Math.random()*1.2});
    }
  }
  window.__burst=function(big){
    var k=big?6:1;
    for(var i=0;i<k;i++) setTimeout(function(){firework(W*(.15+Math.random()*.7),H*(.12+Math.random()*.35))},i*350);
  };

  var t=0;
  function frame(){
    ctx.clearRect(0,0,W,H); t++;
    for(var i=0;i<stars.length;i++){
      var s=stars[i]; s.p+=s.sp; var a=.35+Math.sin(s.p)*.35;
      ctx.globalAlpha=a; ctx.fillStyle='#fff3d6'; ctx.beginPath(); ctx.arc(s.x,s.y,s.r,0,6.283); ctx.fill();
    }
    if(Math.random()<.35) addEmber();
    for(i=embers.length-1;i>=0;i--){
      var e=embers[i]; e.x+=e.vx+Math.sin((t+i)*.02)*.2; e.y+=e.vy; e.life-=.0025;
      if(e.life<=0||e.y<-10){embers.splice(i,1);continue}
      ctx.globalAlpha=e.life*.85;
      var g=ctx.createRadialGradient(e.x,e.y,0,e.x,e.y,e.r*4);
      g.addColorStop(0,'hsla('+e.hue+',100%,75%,1)'); g.addColorStop(1,'hsla('+e.hue+',100%,50%,0)');
      ctx.fillStyle=g; ctx.beginPath(); ctx.arc(e.x,e.y,e.r*4,0,6.283); ctx.fill();
    }
    if(t%170===0 && Math.random()<.8) window.__burst(false);
    for(i=sparks.length-1;i>=0;i--){
      var p=sparks[i]; p.vx*=.985; p.vy=p.vy*.985+.025; p.x+=p.vx; p.y+=p.vy; p.life-=p.decay;
      if(p.life<=0){sparks.splice(i,1);continue}
      ctx.globalAlpha=p.life; ctx.fillStyle=p.col; ctx.beginPath(); ctx.arc(p.x,p.y,p.r*p.life+.3,0,6.283); ctx.fill();
    }
    ctx.globalAlpha=1;
    requestAnimationFrame(frame);
  }
  if(reduce){
    for(var i=0;i<stars.length;i++){var s=stars[i];ctx.globalAlpha=.5;ctx.fillStyle='#fff3d6';ctx.beginPath();ctx.arc(s.x,s.y,s.r,0,6.283);ctx.fill();}
  } else {
    setTimeout(function(){window.__burst(false)},900);
    requestAnimationFrame(frame);
  }
  document.addEventListener('click',function(ev){ if(!reduce && !ev.target.closest('a')) firework(ev.clientX,ev.clientY); });
})();
