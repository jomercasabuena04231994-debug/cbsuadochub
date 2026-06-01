<?php
include('dbconnection.php');


if(isset($_GET['delete_id'])){
    $id = intval($_GET['delete_id']);

   
    $stmt = mysqli_prepare($con, "SELECT doc_file FROM qadocument WHERE doc_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $doc = mysqli_fetch_assoc($result);

    if($doc){
        $filepath = 'uploads/' . $doc['doc_file'];
        if(file_exists($filepath)){
            unlink($filepath);
        }
    }

    
    $stmt2 = mysqli_prepare($con, "DELETE FROM qadocument WHERE doc_id = ?");
    mysqli_stmt_bind_param($stmt2, "i", $id);
    mysqli_stmt_execute($stmt2);

    header("Location: area10.php"); 
    exit;
}


$area = '10';
$stmt3 = mysqli_prepare($con, "SELECT * FROM qadocument WHERE doc_area = ? ORDER BY doc_timeupload DESC");
mysqli_stmt_bind_param($stmt3, "s", $area);
mysqli_stmt_execute($stmt3);
$result = mysqli_stmt_get_result($stmt3);
$documents = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>












<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Area 2 Documents - QA DocHub</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 min-h-screen p-6">
<header class="bg-green-600 text-white p-4 shadow flex justify-between items-center">
    
    <h1 class="text-2xl font-bold">Area X: Administration</h1>

    <div class="flex gap-3">
        <!-- BACK BUTTON -->
        <a href="accreditationviewdocs.php"
           class="bg-gray-200 text-green-700 px-3 py-1 rounded hover:bg-gray-300">
            ← Back
        </a>

        <!-- ADD DOCUMENT BUTTON -->
        <a href="area10addpage.php" 
           class="bg-white text-green-600 px-3 py-1 rounded hover:bg-green-100">
            Add Document
        </a>
    </div>

</header>

<div class="max-w-6xl mx-auto mt-6">
    <div class="bg-white rounded-xl shadow p-6 overflow-x-auto">

        <input type="text" id="searchInput" placeholder="Search documents..."
               class="border rounded px-3 py-2 w-full mb-4" onkeyup="filterDocuments()">

        <table class="w-full table-auto border-collapse">
            <thead class="bg-green-100">
                <tr>
                    <th class="border px-4 py-2">Title</th>
                    <th class="border px-4 py-2">Type</th>
                    <th class="border px-4 py-2">Uploaded By</th>
                    <th class="border px-4 py-2">Uploaded Date</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>

            <tbody id="documentList">
            <?php foreach($documents as $i => $doc): ?>
                <tr class="<?= $i % 2 === 0 ? 'bg-green-50' : '' ?>">
                    <td class="border px-4 py-2"><?= htmlspecialchars($doc['doc_title']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($doc['doc_type']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($doc['docuploadedby']) ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($doc['doc_timeupload']) ?></td>

                    <td class="border px-4 py-2 flex gap-2">
                        <a href="viewfile.php?file=<?= urlencode($doc['doc_file']) ?>" 
                           target="_blank"
                           class="bg-purple-500 hover:bg-purple-600 text-white px-2 py-1 rounded">
                           View
                        </a>

                        <a href="download.php?file=<?= urlencode($doc['doc_file']) ?>"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">
                           Download
                        </a>

                        <a href="edit10.php?id=<?= $doc['doc_id'] ?>"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">
                           Edit
                        </a>

                        <a href="area10.php?delete_id=<?= $doc['doc_id'] ?>"
                           onclick="return confirm('Are you sure you want to delete this document?')"
                           class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

<script>
function filterDocuments(){
    const q = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('#documentList tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>

</body>
</html>
