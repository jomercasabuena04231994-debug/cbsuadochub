<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Accreditation Documents</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen">

<!-- Header -->
<header class="bg-green-600 text-white p-4 shadow">
  <div class="max-w-6xl mx-auto flex justify-between items-center">
    <h1 class="text-2xl font-bold">ACCREDITATION DOCUMENTS</h1>
    <!-- Back to Dashboard Button -->
    <div class="mb-4">
      <button onclick="window.location.href='dashboard.php'" 
              class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
        Back to Dashboard
      </button>
    </div>
  </div>
</header>

<div class="max-w-6xl mx-auto p-6">

  <!-- QA Areas & Documents Table -->
  <div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-bold mb-4 text-green-600">Accreditation Areas Overview</h2>
    <table class="w-full table-auto border-collapse">
      <thead>
        <tr class="bg-green-100">
          <th class="border px-4 py-2 text-left">Area</th>
          <th class="border px-4 py-2 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="border px-4 py-2">Area I: Mission, Goals and Objectives </td>
          <td class="border px-4 py-2">
            <button onclick="window.location.href='area1.php'" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">View</button>
          </td>
        </tr>
        <tr class="bg-green-50">
          <td class="border px-4 py-2">Area II: Faculty</td>
          <td class="border px-4 py-2">
            <button onclick="window.location.href='area2.php'" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">View</button>
          </td>
        </tr>
        <tr>
          <td class="border px-4 py-2">Area III: Curriculum and Instruction</td>
          <td class="border px-4 py-2">
            <button onclick="window.location.href='area3.php'" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">View</button>
          </td>
        </tr>
        <tr class="bg-green-50">
          <td class="border px-4 py-2">Area IV: Support to Students</td>
          <td class="border px-4 py-2">
            <button onclick="window.location.href='area4.php'" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">View</button>
          </td>
        </tr>
        <tr>
          <td class="border px-4 py-2">Area V: Research</td>
          <td class="border px-4 py-2">
            <button onclick="window.location.href='area5.php'" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">View</button>
          </td>
        </tr>
        <tr class="bg-green-50">
          <td class="border px-4 py-2">Area VI: Extension and Community Involvement</td>
          <td class="border px-4 py-2">
            <button onclick="window.location.href='area6.php'" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">View</button>
          </td>
        </tr>
        <tr>
          <td class="border px-4 py-2">Area VII: Library</td>
          <td class="border px-4 py-2">
            <button onclick="window.location.href='area7.php'" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">View</button>
          </td>
        </tr>
        <tr class="bg-green-50">
          <td class="border px-4 py-2">Area VIII: Physical Plant and Facilities</td>
          <td class="border px-4 py-2">
            <button onclick="window.location.href='area8.php'" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">View</button>
          </td>
        </tr>
        <tr>
          <td class="border px-4 py-2">Area IX: Laboratories</td>
          <td class="border px-4 py-2">
            <button onclick="window.location.href='area9.php'" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">View</button>
          </td>
        </tr>
        <tr class="bg-green-50">
          <td class="border px-4 py-2">Area X: Administration</td>
          <td class="border px-4 py-2">
            <button onclick="window.location.href='area10.php'" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">View</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</div>

</body>
</html>
