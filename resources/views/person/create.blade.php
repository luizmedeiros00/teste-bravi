<div>
    <form action="{{ route('person.store') }}" method="POST">
        @csrf
        <input type="text" name="name" />
        <input type="text" name="contacts[1][value]">
        <input type="text" name="contacts[1][type]">

        <input type="text" name="contacts[2][value]">
        <input type="text" name="contacts[2][type]">
        <input type="submit" value="cadastrar">
    </form>
</div>
