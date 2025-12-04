<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1> <?php echo "jhdhghkj" ?> </h1>
  <script>
           // Simple SPA behavior
    const tabs = document.querySelectorAll('[data-tab]');
    const sections = document.querySelectorAll('.tab-content');
    function showTab(name){
      sections.forEach(s=> s.id===name ? s.classList.remove('hidden') : s.classList.add('hidden'));
      tabs.forEach(t=> t.setAttribute('aria-current', t.dataset.tab===name));
      localStorage.setItem('zoo_tab', name);
      render();
    }
    tabs.forEach(t=> t.addEventListener('click', ()=> showTab(t.dataset.tab)));
    


    // Elements
    const animalGrid = document.getElementById('animalGrid');
    const zoneGrid = document.getElementById('zoneGrid');
    const totalAnimals = document.getElementById('totalAnimals');
    const totalZones = document.getElementById('totalZones');
    const totalCarn = document.getElementById('totalCarn');
    const recent = document.getElementById('recent');
    const filterZone = document.getElementById('filterZone');
    const filterDiet = document.getElementById('filterDiet');

    // Modal controls
    const animalModal = document.getElementById('animalModal');
    const animalForm = document.getElementById('animalForm');
    const animalModalTitle = document.getElementById('animalModalTitle');
    const a_name = document.getElementById('a_name');
    const a_image = document.getElementById('a_image');
    const a_diet = document.getElementById('a_diet');
    const a_zone = document.getElementById('a_zone');
    const a_tags = document.getElementById('a_tags');

    const zoneModal = document.getElementById('zoneModal');
    const zoneForm = document.getElementById('zoneForm');
    const z_name = document.getElementById('z_name');
    const z_desc = document.getElementById('z_desc');

    let editingId = null;

    // Helpers
    function save(){
      localStorage.setItem('zoo_animals', JSON.stringify(animals));
      localStorage.setItem('zoo_zones', JSON.stringify(zones));
      render();
    }

    function sampleData(){
      if(animals.length===0 && zones.length===0){
        zones = [
          {id:1,name:'Savane',desc:'Warm grassy area'},
          {id:2,name:'Jungle',desc:'Dense trees'},
          {id:3,name:'Desert',desc:'Hot and dry'},
        ];
        animals = [
          {id:1,name:'Lion',image:'https://placekitten.com/600/400',diet:'Carnivore',zoneId:1,tags:['big','king']},
          {id:2,name:'Elephant',image:'https://placekitten.com/601/400',diet:'Herbivore',zoneId:1,tags:['gentle','huge']},
          {id:3,name:'Monkey',image:'https://placekitten.com/602/400',diet:'Omnivore',zoneId:2,tags:['smart']}
        ];
        save();
      }
    }
    sampleData();

    function render(){
      // Dashboard counts
      totalAnimals.textContent = animals.length;
      totalZones.textContent = zones.length;
      totalCarn.textContent = animals.filter(a=>a.diet==='Carnivore').length;

      // Recent
      recent.innerHTML = '';
      animals.slice(-3).reverse().forEach(a=>{
        const z = zones.find(z=>z.id===a.zoneId)?.name || '—';
        const el = document.createElement('div');
        el.className='p-2 border rounded flex gap-2 items-center';
        el.innerHTML = `<img src="${a.image||'https://placekitten.com/120/80'}" class="w-16 h-12 object-cover rounded" />
          <div><div class="font-semibold">${a.name}</div><div class="text-xs text-gray-500">${z} • ${a.diet}</div></div>`;
        recent.appendChild(el);
      });

      // Filters: zones select
      filterZone.innerHTML = '<option value="">All zones</option>';
      a_zone.innerHTML = '';
      zones.forEach(z=>{
        filterZone.innerHTML += `<option value="${z.id}">${z.name}</option>`;
        a_zone.innerHTML += `<option value="${z.id}">${z.name}</option>`;
      });

      // Animal grid
      animalGrid.innerHTML = '';
      const fZone = filterZone.value;
      const fDiet = filterDiet.value;
      animals.filter(a => (fZone? a.zoneId==fZone : true) && (fDiet? a.diet==fDiet : true)).forEach(a=>{
        const zoneName = zones.find(z=>z.id===a.zoneId)?.name || '—';
        const card = document.createElement('div');
        card.className = 'bg-white rounded-lg overflow-hidden cartoon-shadow';
        card.innerHTML = `
          <div class="h-44 overflow-hidden bg-gray-100 flex items-center justify-center">
            <img src="${a.image||'https://placekitten.com/600/350'}" class="w-full h-full object-cover transform hover:scale-105 transition" />
          </div>
          <div class="p-3">
            <div class="flex items-start justify-between">
              <div>
                <h4 class="font-bold">${a.name}</h4>
                <div class="text-xs text-gray-500">${zoneName} • <span class="font-medium">${a.diet}</span></div>
              </div>
              <div class="flex flex-col gap-2">
                <button data-id="${a.id}" class="editBtn p-1 rounded hover:bg-yellow-50" title="Edit">
                  <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"w-5 h-5 text-yellow-600\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\"><path d=\"M3 21v-3.75L17.81 2.44a2 2 0 0 1 2.83 0l.92.92a2 2 0 0 1 0 2.83L6.75 21H3z\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg>
                </button>
                <button data-id="${a.id}" class="delBtn p-1 rounded hover:bg-red-50" title="Delete">
                  <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"w-5 h-5 text-red-500\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\"><path d=\"M3 6h18M8 6v12a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V6M10 6V4a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v2\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg>
                </button>
              </div>
            </div>

            <div class="mt-3 flex flex-wrap gap-2">
              ${ (a.tags||[]).map(t=>`<span class="text-xs px-2 py-1 rounded-full bg-yellow-50 border">${t}</span>`).join('') }
            </div>
          </div>
        `;
        animalGrid.appendChild(card);
      });

      // zone grid
      zoneGrid.innerHTML = '';
      zones.forEach(z=>{
        const c = document.createElement('div');
        c.className='bg-white p-4 rounded-lg cartoon-shadow';
        c.innerHTML = `<div class="flex items-center justify-between"><div><h4 class=\"font-bold\">${z.name}</h4><div class=\"text-xs text-gray-500\">${z.desc||''}</div></div><div class=\"flex gap-2\"><button data-id=\"${z.id}\" class=\"editZoneBtn p-1 rounded hover:bg-yellow-50\">Edit</button><button data-id=\"${z.id}\" class=\"delZoneBtn p-1 rounded hover:bg-red-50\">Delete</button></div></div>`;
        zoneGrid.appendChild(c);
      });

      // attach events for edit/delete
      document.querySelectorAll('.editBtn').forEach(b=> b.addEventListener('click', ()=> openEditAnimal(b.dataset.id)));
      document.querySelectorAll('.delBtn').forEach(b=> b.addEventListener('click', ()=> deleteAnimal(b.dataset.id)));
      document.querySelectorAll('.editZoneBtn').forEach(b=> b.addEventListener('click', ()=> openEditZone(b.dataset.id)));
      document.querySelectorAll('.delZoneBtn').forEach(b=> b.addEventListener('click', ()=> deleteZone(b.dataset.id)));

    }

    // Add animal flow
    document.getElementById('add-top').addEventListener('click', openAddAnimal);
    document.getElementById('btn-add-top').addEventListener('click', openAddAnimal);

    function openAddAnimal(){
      editingId = null;
      animalModalTitle.textContent = 'Add Animal';
      a_name.value=''; a_image.value=''; a_tags.value=''; a_diet.value='Carnivore';
      if(zones.length>0) a_zone.value = zones[0].id; else a_zone.innerHTML='';
      animalModal.style.display='flex';
    }

    function openEditAnimal(id){
      const a = animals.find(x=> x.id==id); if(!a) return alert('Not found');
      editingId = id;
      animalModalTitle.textContent = 'Edit Animal';
      a_name.value = a.name; a_image.value = a.image; a_diet.value = a.diet; a_zone.value = a.zoneId; a_tags.value = (a.tags||[]).join(',');
      animalModal.style.display='flex';
    }

    document.getElementById('closeAnimalModal').addEventListener('click', ()=> animalModal.style.display='none');
    animalForm.addEventListener('submit', (e)=>{
      e.preventDefault();
      const obj = {name:a_name.value.trim(), image:a_image.value.trim(), diet:a_diet.value, zoneId: Number(a_zone.value), tags: a_tags.value.split(',').map(s=>s.trim()).filter(Boolean)};
      if(editingId){
        const idx = animals.findIndex(x=> x.id==editingId);
        animals[idx] = {...animals[idx], ...obj};
      } else {
        const id = (animals.reduce((m,x)=> Math.max(m,x.id||0),0) || 0) + 1;
        animals.push({id,...obj});
      }
      animalModal.style.display='none';
      save();
    });

    function deleteAnimal(id){
      if(!confirm('Delete this animal?')) return;
      animals = animals.filter(a=> a.id!=id);
      save();
    }

    // Zone management
    document.getElementById('addZoneBtn').addEventListener('click', ()=>{ editingZoneId = null; z_name.value=''; z_desc.value=''; zoneModalTitle.textContent='Add Zone'; zoneModal.style.display='flex';});
    document.getElementById('closeZoneModal').addEventListener('click', ()=> zoneModal.style.display='none');

    let editingZoneId = null;
    zoneForm.addEventListener('submit', (e)=>{
      e.preventDefault();
      if(editingZoneId){
        const idx = zones.findIndex(z=> z.id==editingZoneId);
        zones[idx].name = z_name.value; zones[idx].desc = z_desc.value;
      } else {
        const id = (zones.reduce((m,x)=> Math.max(m,x.id||0),0) || 0) + 1;
        zones.push({id,name:z_name.value,desc:z_desc.value});
      }
      zoneModal.style.display='none';
      save();
    });

    function openEditZone(id){
      const z = zones.find(x=> x.id==id); if(!z) return;
      editingZoneId = id; z_name.value = z.name; z_desc.value = z.desc; zoneModalTitle.textContent='Edit Zone'; zoneModal.style.display='flex';
    }
    function deleteZone(id){
      if(!confirm('Delete this zone?')) return;
      // remove animals in zone too
      animals = animals.filter(a=> a.zoneId!=id);
      zones = zones.filter(z=> z.id!=id);
      save();
    }

    // filters
    filterZone.addEventListener('change', render);
    filterDiet.addEventListener('change', render);

    // search
    document.getElementById('search').addEventListener('input', (e)=>{
      const q = e.target.value.toLowerCase();
      // show animals matching name/tags or zones
      animalGrid.querySelectorAll('div').forEach(()=>{}); // noop; simpler: rebuild with filter
      const prevZone = filterZone.value; const prevDiet = filterDiet.value;
      const results = animals.filter(a=> a.name.toLowerCase().includes(q) || (a.tags||[]).some(t=> t.toLowerCase().includes(q)) || (zones.find(z=>z.id==a.zoneId)?.name||'').toLowerCase().includes(q));
      // temporarily show matches only
      if(q==='') return render();
      animalGrid.innerHTML = '';
      results.forEach(a=>{
        const zoneName = zones.find(z=>z.id===a.zoneId)?.name || '—';
        const card = document.createElement('div');
        card.className = 'bg-white rounded-lg overflow-hidden cartoon-shadow';
        card.innerHTML = `
          <div class="h-44 overflow-hidden bg-gray-100 flex items-center justify-center">
            <img src="${a.image||'https://placekitten.com/600/350'}" class="w-full h-full object-cover" />
          </div>
          <div class="p-3">
            <div class="flex items-start justify-between">
              <div>
                <h4 class="font-bold">${a.name}</h4>
                <div class="text-xs text-gray-500">${zoneName} • <span class="font-medium">${a.diet}</span></div>
              </div>
            </div>
            <div class="mt-3 flex flex-wrap gap-2">
              ${ (a.tags||[]).map(t=>`<span class="text-xs px-2 py-1 rounded-full bg-yellow-50 border">${t}</span>`).join('') }
            </div>
          </div>
        `;
        animalGrid.appendChild(card);
      });
    });

    // open add from sidebar top
    document.getElementById('btn-add-top').addEventListener('click', openAddAnimal);

    // initialize render
    render();



    <?php
$seveur = "localhost";
$nom_utilisateur = "root";
$mot_de_passe = "";
$nom_base_de_donnees = "zoo";
 
$conn = new mysqli($serveur, $nom_utilisateur, $mot_de_passe, $nom_base_de_donnees);
if ($conn->connect_error) {
  die("Connection failed : " .$conn->connect_error);
}

 $sql = "SELECT name, image, Type_alimentaire FROM animals"
 if($result = $conn->query($sql)){
  if(mysqli_num_rows($result)> 0){
    echo "<div class="grid grid-rows-3">";
    echo "<div></div>";
    echo "<p></p>"
  }
 }


 ?>







  </script>
</body>
</html>
    