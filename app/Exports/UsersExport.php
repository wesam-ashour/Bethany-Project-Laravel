<?php

namespace App\Exports;

use App\Models\Event;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use \Maatwebsite\Excel\Concerns\Exportable;

    private $id;

    public function __construct($id)
    {

        $this->id = $id;
    }

    public function view(): View
    {
        $users = DB::table('event_user')->where('event_id', '=', $this->id)->get();
        return view('forms.events.excel', [
            'users' => $users,
        ]);
    }
}
