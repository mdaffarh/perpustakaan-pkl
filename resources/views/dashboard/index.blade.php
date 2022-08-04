<h1>Halo {{ auth()->user()->name }}</h1>
<form method="POST" action="/logout">
    @csrf
    <button type="submit" value="Logout">Logout</button>
</form>