<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FeatureController extends Controller
{
    public function index()
    {
        $check = User::where('email', auth()->user()->email)->first();
        if (!$check->password) {
            return view('main.change_profile', ['title' => 'Change Profile']);
        } else {
            return view('feature.payPal', ['title' => 'PayPal Testing']);
        }
    }

    public function query(Request $request)
    {
        // dd($request);
        if ($request->ajax()) {
            $search = $request->get('query');
            $output = "";
            if ($search == '') {
                // $data = User::all()->orderBy('points', 'desc');
                // $data = DB::table('users')->orderBy('points', 'desc')->get();
                $data = DB::table('users')->orderBy('points', 'desc')->limit(10)->get();
                $output .= "
                        <table class='table'>
                            <thead>
                            <tr>
                                <th scope='col'>No</th>
                                <th scope='col'>Name</th>
                                <th scope='col'>Points</th>
                            </tr> 
                            </thead>
                                <tbody>
                    ";
                $count = 1;
                foreach ($data as $data) {
                    $output .= "
                        <tr>
                            <th scope='row'>$count</th>
                            <td>$data->name</td>
                            <td>$data->points</td>
                        </tr>
                        ";
                    $count++;
                }
                $output .= "
                                </tbody>
                        </table>
                        <br><br>";
            } else {
                // $data = User::where('name', 'like', "%$search%")->orderBy
                // ('points', 'desc')->get();
                $data = DB::table('users')->where('name', 'like', "%$search%")->orderBy('points', 'desc')->limit(10)->get();
                // $output = "";
                $count = 1;

                if ($data->count() > 0) {
                    $output .= "
                        <table class='table'>
                            <thead>
                            <tr>
                                <th scope='col'>No</th>
                                <th scope='col'>Name</th>
                                <th scope='col'>Points</th>
                            </tr> 
                            </thead>
                                <tbody>
                    ";
                    foreach ($data as $data) {
                        $output .= "
                        <tr>
                            <th scope='row'>$count</th>
                            <td>$data->name</td>
                            <td>$data->points</td>
                        </tr>
                        ";
                        $count++;
                    }
                    $output .= "
                                </tbody>
                        </table>
                        <br><br>";
                } else {
                    $output = "<h5> Data not found </h5>";
                }
            }
            $result = array('table_data' => $output);

            echo json_encode($result);
        }
    }
    public function load_data(Request $request)
    {
        $limit = 10;
        if ($request->ajax()) {
            if ($request->points > 0) {
                $data = DB::table('users')->where('points', '<', $request->points)->orderBy('points', 'desc')->limit($limit)->get();
            } else {
                $data = DB::table('users')->orderBy('points', 'desc')->limit($limit)->get();
            }

            $output = '';
            $last_points = '';
            $count = 1;

            if (!$data->isEmpty()) {
                $output .= "
                <table class='table'>
                    <thead>
                    <tr>
                        <th scope='col'>No</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Points</th>
                    </tr> 
                    </thead>
                        <tbody>";
               
                foreach ($data as $data) {
                    $output .= "
                        <tr>
                            <th scope='row'>" . $count++ . "</th>
                            <td>$data->name</td>
                            <td>$data->points</td>
                        </tr>
                        ";
                    // $output .= "
                    // <div class='row'>
                    //     <div class='col-md-12'><h3>$row->id</h3></div>
                    //     <div class='col-md-12'><h3>$row->name</h3></div>
                    //     <div class='col-md-6'>$row->points</div>
                    // </div>
                    // ";
                    $last_points = $data->points;
                }
                $output .= "
                        </tbody>
                        </table>";
                if($count > $limit) {
                    $output .= "
                    <div id='load-more'>
                        <button type='button' id='load_more_button' name='load_more_button' class='btn btn-info form-control' data-points='$last_points'>Load More</button>
                    </div>
                    ";
                }
            } else {
                $output .= '
                <div id="load_more">
                    <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
                </div>
                ';
            }
            echo $output;
        }
        // $json = array('table_data' => $output);
        
    }

    public function load_names(Request $request)
    {
        $limit = 10;
        if ($request->ajax()) {
            $newData = false;
            if ($request->points > 0) {
                $data = DB::table('users')->where('points', '<', $request->points)->where('name', 'like',  "%$request->name%")->orderBy('points', 'desc')->limit($limit)->get();
            } else {
                $data = DB::table('users')->where('name', 'like',  "%$request->name%")->orderBy('points', 'desc')->limit($limit)->get();
                $newData = true;
            }

            $output = '';
            $last_points = '';
            $count = 1;

            if (!$data->isEmpty()) {
                $output .= "
                <table class='table'>
                    <thead>
                    <tr>
                        <th scope='col'>No</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Points</th>
                    </tr> 
                    </thead>
                        <tbody>";

                foreach ($data as $data) {
                    $output .= "
                        <tr>
                            <th scope='row'>" . $count++ . "</th>
                            <td>$data->name</td>
                            <td>$data->points</td>
                        </tr>
                        ";
                    // $output .= "
                    // <div class='row'>
                    //     <div class='col-md-12'><h3>$data->id</h3></div>
                    //     <div class='col-md-12'><h3>$data->name</h3></div>
                    //     <div class='col-md-6'>$data->points</div>
                    // </div>
                    // ";
                    $last_points = $data->points;
                }
                $output .= "
                        </tbody>
                        </table>";
                if ($count > $limit) {
                    $output .= "
                <div id='load-more'>
                    <button type='button' id='load_more_names' name='load_more_names' class='btn btn-warning form-control' data-points='$last_points'>Load More</button>
                </div>
                ";
                }
            } else {
                $output .= '
                    <div id="load_more">
                        <button type="button" name="load_more_names" class="btn btn-info form-control">No Data Found</button>
                    </div>
                    ';
            }
            $json = array(
                'output' => $output,
                'new_data' => $newData,
                // 'count' => $count,
            );

            // echo $output;
            echo json_encode($json);
        }

        // $json = array('table_data' => $output);
        // echo $output;
    }

    public function payPalPayment(Request $request) {
        if($request->ajax()) {
            $points = $request->amount;
            // $points = (double)$request->amount;

            $points = $points / 5000 * 100;

            $user_point = User::where('email', auth()->user()->email)->first();

            $points += $user_point->points;

            User::where('email', auth()->user()->email)->update([
                'points' => $points,
            ]);

            echo "Donation successfully made !";
        }
    }
}
