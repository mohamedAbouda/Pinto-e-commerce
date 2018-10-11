<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Models\FileCSV;
use League\Csv\Reader;
use Validator;

class SubscriberController extends BaseController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['resources'] = Subscriber::orderBy('id','DESC')->paginate(20);
        $data['total_resources_count'] = Subscriber::count();
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * 20) - 20;
        return view('dashboardV2.subscripers.index' , $data);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        alert()->success('Deleted successfully.', 'Success');
        return redirect()->back();
    }

    /**
    * Display a Page that contains form to upload csv file.
    *
    * @return \Illuminate\Http\Response
    */
    public function import()
    {
        return view('dashboardV2.subscripers.import');
    }

    /**
    * import subscribers from csv file.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function fetch(Request $request)
    {
        $validator = Validator::make($request->all(), ['file' => 'required']);
        if ($validator->fails()) {
            alert()->error('Please uploead a CSV file', 'Error');
            return back();
        }
        // $this->validate($request, ['file' => 'required']);

        // check extension of the file
        if ($request->file('file')->getClientOriginalExtension() != 'csv') {
            alert()->error('Wrong file. Only available extension is CSV.', 'Error');
            return back();
        }

        // Save file in database
        $csv = new FileCSV;
        $csv['path'] = $request->file('file')->store('csv/subscribers');
        $csv->save();

        // Get path of the file
        $path = realpath('storage/app/' . $csv['path']);

        // Load the file
        if ($reader = Reader::createFromPath($path)->setDelimiter(',')) {
            $succeed = 0;
            $failed = 0;

            // Create new subscribers at database
            $results = $reader->fetch();
            foreach ($results as $row) {
                if (sizeof($row) > 1) {
                    $exists = Subscriber::where('email' , $row[0])->exists();
                    if ($exists) {
                        continue;
                    }
                    try {
                        $user_data['email'] = $row[0];
                        Subscriber::create($user_data);
                        $succeed++;
                    } catch (\Exception $exception) {
                        $failed++;
                    }

                }
                //  else {
                //      return back()->with('info', 'A row at the file has less number of the required parameters.');
                //  }
            }
            alert()->success($succeed . ' subscribers imported successfully and ' . $failed . ' failed.', 'Success');
            return redirect()->route('dashboard.subscribers.index');
        }
        alert()->error('Failed loading the file. Try again with a correct file.', 'Error');
        return back();
    }
}
