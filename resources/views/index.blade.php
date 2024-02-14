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
        <h1>Welcome to GIS Oil Concession Project</h1>
        <p>This is the landing page for the GIS Oil Concession Project.</p>

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
    /* styles.css */

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    font-size: 2rem;
    margin-bottom: 20px;
}

h2 {
    font-size: 1.5rem;
    margin-top: 30px;
    margin-bottom: 10px;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin-bottom: 10px;
}

a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}

</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const scroll = new SmoothScroll('a[href*="#"]', {
        speed: 800
    });
});
</script>
