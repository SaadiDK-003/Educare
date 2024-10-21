<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Assignments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            color: rgb(230, 209, 115);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            background-color: rgb(230, 209, 115);
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: rgb(230, 209, 115);
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
        }
        a{
            color: chocolate;
            text-decoration: none;
            font-size: 20px;
            padding:1%; 
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Manage Assignments</h1>

        <div class="section">
            <h2>Add New Assignment</h2>
            <label for="assignment-title">Assignment Title:</label>
            <input type="text" id="assignment-title" placeholder="Enter assignment title">
            <label for="assignment-description">Assignment Description:</label>
            <textarea id="assignment-description" rows="4" placeholder="Enter assignment description"></textarea>
            <label for="Assi-file"> Assignment file </label>
            <input type="file" id="assi-file" placeholder="Upload the file">
            <button>Add Assignment</button>
        </div>

        <div class="section">
            <h2>Existing Assignments</h2>
            <ul id="assignment-list">
                <li>
                    <span>Assignment 1</span>
                    <div>
                        <button>Edit</button>
                        <button>Delete</button>
                    </div>
                </li>
                <li>
                    <span>Assignment 2</span>
                    <div>
                        <button>Edit</button>
                        <button>Delete</button>
                    </div>
                </li>
                <li>
                    <span>Assignment 3</span>
                    <div>
                        <button>Edit</button>
                        <button>Delete</button>
                    </div>
                </li>
            </ul>
        </div>
        <a href="admin.html">Back > </a>
    </div>

</body>
</html>
