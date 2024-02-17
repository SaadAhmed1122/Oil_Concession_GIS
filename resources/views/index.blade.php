<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS Oil Concession Project</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="card">
            <h2>Oil Concession Summary</h2>
            <div class="info">Total Concessions: {{ $totalConcessions }}</div>
            <div class="info">Total Wells: {{ $totalWells }}</div>
            <div class="info">Total Tanks: {{ $totalTanks }}</div>
            <div class="info">Total Inspections: {{ $totalInspections }}</div>
        </div>

        <h1>Welcome to GIS Oil Concession Project</h1>
        <h2>Navigation</h2>
        <ul>
            <li><a href="{{ route('concessions.showAll') }}">View All Concessions</a></li>
            <li><a href="{{ route('well.list') }}">View All Wells</a></li>
            <li><a href="{{ route('tank.index') }}">View All Tanks</a></li>
            <li><a href="{{ route('inspections.index') }}">View All Inspections</a></li>
        </ul>

        <h2>Actions</h2>
        <ul>
            <li><a href="{{ route('concessions.create') }}">Create a New Concession</a></li>
            <li><a href="{{ route('well.create') }}">Create a New Well</a></li>
            <li><a href="{{ route('tanks.create') }}">Create a New Tank</a></li>
            <li><a href="{{ route('inspections.create') }}">Schedule a New Inspection</a></li>
        </ul>
    </div>
</body>

</html>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card h2 {
        margin-top: 0;
        color: #333;
    }

    .info {
        font-size: 18px;
        margin-bottom: 10px;
        color: #555;
    }

    h1,
    h2 {
        color: #333;
    }

    p {
        color: #666;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    ul li {
        margin-bottom: 10px;
    }

    ul li a {
        text-decoration: none;
        color: #007bff;
    }

    ul li a:hover {
        color: #0056b3;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scroll = new SmoothScroll('a[href*="#"]', {
            speed: 800
        });
    });
</script>
