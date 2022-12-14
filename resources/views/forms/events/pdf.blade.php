<!DOCTYPE html>
<html @if(App::getLocale() == 'en') lang="en" dir="ltr" @else lang="ar" dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ __('event.register') }}</title>
    <style>
        body {
            font-family: arial, sans-serif;
            letter-spacing: -0.3px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid black;
            padding: 4px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<strong>{{ __('event.register') }}<span> ({{count($pd)}})</span></strong>
<br>
<br>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('user.Full') }}</th>
        <th scope="col">{{ __('user.Email') }}</th>
        <th scope="col">{{ __('user.email_verified') }}</th>
        <th scope="col">{{ __('user.created_at') }}</th>

    </tr>
    </thead>
    <tbody>

    @foreach ($pd as $p)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ \App\Models\User::find($p->user_id)->full_name }}</td>
            <td>{{ \App\Models\User::find($p->user_id)->email }}</td>
            <td>
                @if(\App\Models\User::find($p->user_id)->email_verified == 'true')
                    <div class="badge badge-light-success">{{trans("user.true")}}</div>
                @else
                    <div class="badge badge-light-danger">{{trans("user.false")}}</div>
                @endif
            </td>
            <td>{{ \App\Models\User::find($p->user_id)->created_at }}</td>

        </tr>
    @endforeach

    </tbody>
</table>
</body>

</html>


