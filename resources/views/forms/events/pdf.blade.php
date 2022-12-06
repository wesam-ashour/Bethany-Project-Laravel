<!DOCTYPE html>

<html>

<head>

    <title>PDF</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>


<p>Register Users in event<span>({{count($pd)}})</span></p>


<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Full Name</th>
        <th scope="col">Email</th>
        <th scope="col">Username</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($pd as $p)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ \App\Models\User::find($p->user_id)->full_name }}</td>
            <td>{{ \App\Models\User::find($p->user_id)->email }}</td>
            <td>{{ \App\Models\User::find($p->user_id)->user_name }}</td>
        </tr>
    @endforeach
    </tbody>

</table>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>

</html>
