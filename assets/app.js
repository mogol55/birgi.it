(() => {
  const list = [...document.querySelectorAll('.track')];
  const player = document.getElementById('player');
  const search = document.getElementById('search');
  let current = -1;
  function playAt(i){ if(i<0||i>=list.length)return; current=i; const item=list[i]; player.src='/' + item.dataset.src; player.play(); list.forEach(li=>li.classList.remove('active')); item.classList.add('active'); }
  list.forEach((li,i)=>li.querySelector('.track-btn')?.addEventListener('click',()=>playAt(i)));
  search?.addEventListener('input',()=>{const q=search.value.toLowerCase();list.forEach(li=>li.style.display=li.dataset.title.includes(q)?'':'none');});
  player?.addEventListener('ended',()=>playAt((current+1)%list.length));
})();
