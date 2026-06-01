<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Grading Management System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { color: #2c3e50; }
        form { margin-bottom: 30px; }
        input, select, button { padding: 5px; margin: 5px 0; }
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        table, th, td { border: 1px solid #333; }
        th, td { padding: 8px; text-align: left; }
        .container { max-width: 800px; margin: auto; }
        nav a { margin-right: 15px; text-decoration: none; color: #2980b9; }
    </style>
</head>
<body>
<div class="container">
    <h1>School Grading Management System</h1>
    
    <!-- Navigation -->
    <nav>
        <a href="#add-student">Add Student</a>
        <a href="#add-subject">Add Subject</a>
        <a href="#add-grade">Add Grade</a>
        <a href="#view-grades">View Grades</a>
        <a href="#report-card">Report Card</a>
    </nav>

    <!-- Add Student -->
    <section id="add-student">
        <h2>Add Student</h2>
        <form>
            <input type="text" placeholder="Student Name" required><br>
            <input type="text" placeholder="Class" required><br>
            <button type="submit">Add Student</button>
        </form>
    </section>

    <!-- Add Subject -->
    <section id="add-subject">
        <h2>Add Subject</h2>
        <form>
            <input type="text" placeholder="Subject Name" required><br>
            <button type="submit">Add Subject</button>
        </form>
    </section>

    <!-- Add Grade -->
    <section id="add-grade">
        <h2>Add Grade</h2>
        <form>
            <select>
                <option>Student A</option>
                <option>Student B</option>
            </select><br>
            <select>
                <option>Math</option>
                <option>Science</option>
            </select><br>
            <input type="number" placeholder="Score" step="0.01"><br>
            <button type="submit">Add Grade</button>
        </form>
    </section>

    <!-- View Grades -->
    <section id="view-grades">
        <h2>All Grades</h2>
        <table>
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Score</th>
            </tr>
            <tr>
                <td>Student A</td>
                <td>Math</td>
                <td>95</td>
            </tr>
            <tr>
                <td>Student B</td>
                <td>Science</td>
                <td>88</td>
            </tr>
        </table>
    </section>

    <!-- Report Card -->
    <section id="report-card">
        <h2>Student Report Card</h2>
        <table>
            <tr>
                <th>Subject</th>
                <th>Score</th>
            </tr>
            <tr>
                <td>Math</td>
                <td>95</td>
            </tr>
            <tr>
                <td>Science</td>
                <td>88</td>
            </tr>
            <tr>
                <td><strong>Average</strong></td>
                <td><strong>91.5</strong></td>
            </tr>
        </table>
    </section>
</div>
</body>
</html>