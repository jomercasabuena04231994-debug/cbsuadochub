<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CBSUA QA DocHub Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

<!-- LEFT SIDEBAR -->
<aside class="w-64 bg-green-600 text-white flex flex-col fixed inset-y-0 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out z-20">
  <div class="p-6 text-2xl font-bold text-center border-b border-green-500">
    CBSUA QA DocHub
  </div>
  <nav class="flex-1 p-4 space-y-2">
    <a href="#" class="flex items-center py-2 px-4 rounded bg-green-800 hover:bg-green-700">Dashboard</a>
    <a href="#" class="flex items-center py-2 px-4 rounded hover:bg-green-700">Colleges</a>
    <a href="#" class="flex items-center py-2 px-4 rounded hover:bg-green-700">Programs</a>
    <a href="#" class="flex items-center py-2 px-4 rounded hover:bg-green-700">Accreditation</a>
    <a href="#" class="flex items-center py-2 px-4 rounded hover:bg-green-700">Documents</a>
    <a href="#" class="flex items-center py-2 px-4 rounded hover:bg-green-700">Users</a>
  </nav>
</aside>

<!-- MAIN CONTENT -->
<main class="flex-1 ml-0 md:ml-64 p-6" id="mainContent">
  <div id="contentArea"></div>
</main>

<!-- MODALS -->
<!-- Announcement Modal -->
<div id="announcementModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-30">
  <div class="bg-white p-6 rounded w-96">
    <h2 class="text-xl font-bold mb-4" id="announcementModalTitle">Add Announcement</h2>
    <form id="announcementForm">
      <input type="text" id="announcementTitle" placeholder="Title" class="border p-2 w-full mb-2" required/>
      <textarea id="announcementContent" placeholder="Content" class="border p-2 w-full mb-4" required></textarea>
      <div class="flex justify-end space-x-2">
        <button type="button" onclick="closeModal('announcementModal')" class="bg-gray-500 text-white px-3 py-1 rounded">Cancel</button>
        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- Accreditation Modal -->
<div id="accreditationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-30">
  <div class="bg-white p-6 rounded w-96">
    <h2 class="text-xl font-bold mb-4" id="accreditationModalTitle">Add Accreditation Schedule</h2>
    <form id="accreditationForm">
      <input type="text" id="programName" placeholder="Program Name" class="border p-2 w-full mb-2" required/>
      <input type="text" id="programLevel" placeholder="Level / Type" class="border p-2 w-full mb-2" required/>
      <input type="date" id="programDate" class="border p-2 w-full mb-2" required/>
      <textarea id="programNotes" placeholder="Notes" class="border p-2 w-full mb-4"></textarea>
      <div class="flex justify-end space-x-2">
        <button type="button" onclick="closeModal('accreditationModal')" class="bg-gray-500 text-white px-3 py-1 rounded">Cancel</button>
        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- College Modal -->
<div id="collegeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-30">
  <div class="bg-white p-6 rounded w-96">
    <h2 class="text-xl font-bold mb-4" id="collegeModalTitle">Add College</h2>
    <form id="collegeForm">
      <input type="text" id="collegeName" placeholder="College Name" class="border p-2 w-full mb-2" required/>
      <textarea id="collegeDesc" placeholder="Description" class="border p-2 w-full mb-4" required></textarea>
      <div class="flex justify-end space-x-2">
        <button type="button" onclick="closeModal('collegeModal')" class="bg-gray-500 text-white px-3 py-1 rounded">Cancel</button>
        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- Program Modal -->
<div id="programModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-30">
  <div class="bg-white p-6 rounded w-96">
    <h2 class="text-xl font-bold mb-4" id="programModalTitle">Add Program</h2>
    <form id="programForm">
      <input type="text" id="programNameInput" placeholder="Program Name" class="border p-2 w-full mb-2" required/>
      <input type="text" id="programLevelInput" placeholder="Program Level" class="border p-2 w-full mb-2" required/>
      <input type="date" id="programAccreditationInput" placeholder="Last Accreditation" class="border p-2 w-full mb-2" required/>
      <div class="flex justify-end space-x-2">
        <button type="button" onclick="closeModal('programModal')" class="bg-gray-500 text-white px-3 py-1 rounded">Cancel</button>
        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
const contentArea = document.getElementById('contentArea');

// --------------------- DATA ---------------------
let totalUsers = 10;

let colleges = [
  { name: "College of Arts and Sciences", description: "Liberal arts, sciences" },
  { name: "College of Education", description: "Future educators" },
  { name: "College of Engineering", description: "Engineering programs" }
];

let programs = [
  { name: "BS Computer Science", level: "Level 1", lastAccreditation: "2025-12-20" },
  { name: "BS Information Technology", level: "Level 2", lastAccreditation: "2024-10-15" }
];

let announcements = [
  { title: "Welcome", content: "Welcome to CBSUA QA DocHub!" }
];

let accreditations = [
  { programName: "BS Computer Science", level: "Level 1", date: "2025-12-20", notes: "Initial accreditation" }
];

let editAnnouncementIndex = null;
let editAccreditationIndex = null;
let editCollegeIndex = null;
let editProgramIndex = null;

// --------------------- DASHBOARD ---------------------
function showDashboard() {
  // Exact same dashboard as previous code
  let html = `
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      <div class="bg-white p-4 rounded shadow flex items-center justify-between">
        <div>
          <h3 class="text-gray-500">Users</h3>
          <p class="text-2xl font-bold" id="totalUsers">${totalUsers}</p>
        </div>
      </div>
      <div class="bg-white p-4 rounded shadow flex items-center justify-between">
        <div>
          <h3 class="text-gray-500">Colleges</h3>
          <p class="text-2xl font-bold" id="totalColleges">${colleges.length}</p>
        </div>
      </div>
      <div class="bg-white p-4 rounded shadow flex items-center justify-between">
        <div>
          <h3 class="text-gray-500">Programs</h3>
          <p class="text-2xl font-bold" id="totalPrograms">${programs.length}</p>
        </div>
      </div>
      <div class="bg-white p-4 rounded shadow flex items-center justify-between">
        <div>
          <h3 class="text-gray-500">Accredited Programs</h3>
          <p class="text-2xl font-bold" id="totalAccredited">${accreditations.length}</p>
        </div>
      </div>
    </div>

    <!-- Announcements Section -->
    <div class="mb-6">
      <div class="flex justify-between items-center mb-2">
        <h2 class="text-xl font-semibold">Announcements</h2>
        <button onclick="openAddAnnouncement()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
          Add
        </button>
      </div>
      <div class="bg-white p-4 rounded shadow">
        ${announcements.map((a, i) => `
          <div class="mb-2 border-b pb-2 flex justify-between items-start">
            <div>
              <h3 class="font-semibold">${a.title}</h3>
              <p class="text-gray-600">${a.content}</p>
            </div>
            <div class="flex space-x-2">
              <button onclick="editAnnouncement(${i})" class="text-blue-600 hover:underline">Edit</button>
              <button onclick="deleteAnnouncement(${i})" class="text-red-600 hover:underline">Delete</button>
            </div>
          </div>
        `).join('')}
        ${announcements.length === 0 ? '<p>No announcements yet.</p>' : ''}
      </div>
    </div>

    <!-- Accreditation Section -->
    <div class="mb-6">
      <div class="flex justify-between items-center mb-2">
        <h2 class="text-xl font-semibold">Accreditation Schedules</h2>
        <button onclick="openAddAccreditation()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add</button>
      </div>
      <div class="bg-white p-4 rounded shadow overflow-x-auto">
        <table class="min-w-full table-auto border-collapse">
          <thead>
            <tr class="bg-green-600 text-white">
              <th class="px-4 py-2 border">Program Name</th>
              <th class="px-4 py-2 border">Level / Type</th>
              <th class="px-4 py-2 border">Scheduled Date</th>
              <th class="px-4 py-2 border">Notes</th>
              <th class="px-4 py-2 border">Actions</th>
            </tr>
          </thead>
          <tbody>
            ${accreditations.map((a, i) => `
              <tr>
                <td class="border px-4 py-2">${a.programName}</td>
                <td class="border px-4 py-2">${a.level}</td>
                <td class="border px-4 py-2">${a.date}</td>
                <td class="border px-4 py-2">${a.notes}</td>
                <td class="border px-4 py-2">
                  <button class="text-blue-600 hover:underline mr-2" onclick="editAccreditation(${i})">Edit</button>
                  <button class="text-red-600 hover:underline" onclick="deleteAccreditation(${i})">Delete</button>
                </td>
              </tr>
            `).join('')}
          </tbody>
        </table>
      </div>
    </div>
  `;
  contentArea.innerHTML = html;
}

// --------------------- COLLEGES ---------------------
function showColleges() {
  let html = `
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold">Colleges</h1>
      <div class="flex space-x-2">
        <input type="text" id="collegeSearch" placeholder="Search..." class="border p-2 rounded" oninput="filterColleges()"/>
        <button onclick="openAddCollege()" class="bg-green-600 p-2 rounded hover:bg-green-700" title="Add College">+</button>
      </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="collegeCards">
  `;
  colleges.forEach((c,i)=>{
    html += `
      <div class="bg-white p-4 rounded shadow hover:shadow-lg">
        <h2 class="text-lg font-semibold mb-2">${c.name}</h2>
        <p class="text-gray-600">${c.description}</p>
        <div class="flex justify-end mt-2 space-x-2">
          <button onclick="editCollege(${i})" class="text-blue-600 hover:underline">Edit</button>
          <button onclick="deleteCollege(${i})" class="text-red-600 hover:underline">Delete</button>
        </div>
      </div>
    `;
  });
  html += `</div>`;
  contentArea.innerHTML = html;
}

function filterColleges(){
  const s=document.getElementById('collegeSearch').value.toLowerCase();
  const f=colleges.filter(c=>c.name.toLowerCase().includes(s));
  let html='';
  f.forEach((c,i)=>{
    html+=`<div class="bg-white p-4 rounded shadow hover:shadow-lg">
      <h2 class="text-lg font-semibold mb-2">${c.name}</h2>
      <p class="text-gray-600">${c.description}</p>
      <div class="flex justify-end mt-2 space-x-2">
        <button onclick="editCollege(${i})" class="text-blue-600 hover:underline">Edit</button>
        <button onclick="deleteCollege(${i})" class="text-red-600 hover:underline">Delete</button>
      </div>
    </div>`;
  });
  document.getElementById('collegeCards').innerHTML=html;
}

// --------------------- PROGRAMS ---------------------
function showPrograms() {
  let html = `
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold">Programs</h1>
      <div class="flex space-x-2">
        <input type="text" id="programSearch" placeholder="Search..." class="border p-2 rounded" oninput="filterPrograms()"/>
        <button onclick="openAddProgram()" class="bg-green-600 p-2 rounded hover:bg-green-700" title="Add Program">+</button>
      </div>
    </div>
    <div class="bg-white p-4 rounded shadow overflow-x-auto">
      <table class="min-w-full table-auto border-collapse">
        <thead>
          <tr class="bg-green-600 text-white">
            <th class="px-4 py-2 border">Program</th>
            <th class="px-4 py-2 border">Program Level</th>
            <th class="px-4 py-2 border">Last Accreditation</th>
            <th class="px-4 py-2 border">Actions</th>
          </tr>
        </thead>
        <tbody id="programTableBody">
          ${programs.map((p,i)=>`
            <tr>
              <td class="border px-4 py-2">${p.name}</td>
              <td class="border px-4 py-2">${p.level}</td>
              <td class="border px-4 py-2">${p.lastAccreditation}</td>
              <td class="border px-4 py-2">
                <button class="text-blue-600 hover:underline mr-2" onclick="editProgram(${i})">Edit</button>
                <button class="text-red-600 hover:underline" onclick="deleteProgram(${i})">Delete</button>
              </td>
            </tr>
          `).join('')}
        </tbody>
      </table>
    </div>
  `;
  contentArea.innerHTML = html;
}

function filterPrograms() {
  const s = document.getElementById('programSearch').value.toLowerCase();
  const f = programs.filter(p => p.name.toLowerCase().includes(s));
  let html = '';
  f.forEach((p,i)=>{
    html += `<tr>
      <td class="border px-4 py-2">${p.name}</td>
      <td class="border px-4 py-2">${p.level}</td>
      <td class="border px-4 py-2">${p.lastAccreditation}</td>
      <td class="border px-4 py-2">
        <button class="text-blue-600 hover:underline mr-2" onclick="editProgram(${i})">Edit</button>
        <button class="text-red-600 hover:underline" onclick="deleteProgram(${i})">Delete</button>
      </td>
    </tr>`;
  });
  document.getElementById('programTableBody').innerHTML = html;
}

// --------------------- MODAL FUNCTIONS ---------------------
function openAddCollege(){ editCollegeIndex=null; document.getElementById('collegeModalTitle').textContent='Add College'; document.getElementById('collegeName').value=''; document.getElementById('collegeDesc').value=''; openModal('collegeModal'); }
function openAddProgram(){ editProgramIndex=null; document.getElementById('programModalTitle').textContent='Add Program'; document.getElementById('programNameInput').value=''; document.getElementById('programLevelInput').value=''; document.getElementById('programAccreditationInput').value=''; openModal('programModal'); }
function editProgram(i){ editProgramIndex=i; document.getElementById('programModalTitle').textContent='Edit Program'; document.getElementById('programNameInput').value=programs[i].name; document.getElementById('programLevelInput').value=programs[i].level; document.getElementById('programAccreditationInput').value=programs[i].lastAccreditation; openModal('programModal'); }
function deleteProgram(i){ if(confirm('Delete this program?')){ programs.splice(i,1); showPrograms(); } }

function openModal(id){ document.getElementById(id).classList.remove('hidden'); document.getElementById(id).classList.add('flex'); }
function closeModal(id){ document.getElementById(id).classList.add('hidden'); document.getElementById(id).classList.remove('flex'); }

// --------------------- FORM SUBMISSIONS ---------------------
document.getElementById('collegeForm').addEventListener('submit', function(e){ e.preventDefault(); const name=document.getElementById('collegeName').value; const desc=document.getElementById('collegeDesc').value; if(editCollegeIndex!==null){ colleges[editCollegeIndex]={name,description:desc}; }else{ colleges.push({name,description:desc}); } closeModal('collegeModal'); showColleges(); });
document.getElementById('programForm').addEventListener('submit', function(e){ e.preventDefault(); const n=document.getElementById('programNameInput').value; const l=document.getElementById('programLevelInput').value; const d=document.getElementById('programAccreditationInput').value; if(editProgramIndex!==null){ programs[editProgramIndex]={name:n,level:l,lastAccreditation:d}; }else{ programs.push({name:n,level:l,lastAccreditation:d}); } closeModal('programModal'); showPrograms(); });

// --------------------- SIDEBAR NAV ---------------------
document.querySelectorAll('aside nav a').forEach(link=>{
  link.addEventListener('click',e=>{
    e.preventDefault();
    const t=link.textContent.trim();
    if(t==='Dashboard') showDashboard();
    else if(t==='Colleges') showColleges();
    else if(t==='Programs') showPrograms();
  });
});

// Load Dashboard by default
showDashboard();
</script>
</body>
</html>
