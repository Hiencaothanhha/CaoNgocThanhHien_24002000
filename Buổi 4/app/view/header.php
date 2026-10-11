<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quản lý Cửa hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: gray;
        }
        a:hover {
            color: black;
        }
        form {
            width: 320px;
            margin: 40px auto;
        }
        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-row label {
            width: 120px; 
        }

        .form-row input {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 200px;
        }

        button {
            padding: 6px 20px;
            border: 1px solid #999;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: whitesmoke;
        }

        .action-buttons {
            width: 320px;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Quản lý Cửa hàng</h1>