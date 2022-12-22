<table>
    <thead>
    <tr>
        <th>Full name</th>
        <th>Email</th>
        <th>Email verified</th>
        <th>Add at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ \App\Models\User::find($user->user_id)->full_name }}</td>
            <td>{{ \App\Models\User::find($user->user_id)->email }}</td>
            <td>{{ \App\Models\User::find($user->user_id)->email_verified }}</td>
            <td>{{ $user->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
