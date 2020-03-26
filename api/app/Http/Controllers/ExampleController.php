<?php

namespace App\Http\Controllers;

class ExampleController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        /*DB::beginTransaction();
        try {
            $project = Project::find($id);
            $project->users()->detach();
            $project->delete();
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if ($success) {
            // the transaction worked ...
        }*/
    }

    //
}
