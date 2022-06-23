<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donation;
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

    public function init_page()
    {
        // $total_donation = Donation::with(['users'])->sum('money_amount')->get();
        return view('testing.landing', ['donations' => Donation::with(['users'])->orderBy('created_at', 'desc')->get()]);
    }

    public function home()
    {
        $pwd = User::where('email', auth()->user()->email)->first();
        // dd($pwd->password);
        if ($pwd->password == null) {
            return view('testing.main.change_profile', ['title' => 'Edit Profile']);
        } else {
            return view('testing.landing', ['donations' => Donation::with(['users'])->orderBy('created_at', 'desc')->get()]);
        }
    }

    public function payment_success()
    {
        return view('testing.main.paymentSuccess', ['title' => 'Success']);
    }
    public function payment_failed()
    {
        return view('testing.main.paymentFailed', ['title' => 'Failed']);
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
                if ($count > $limit) {
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
            $output = "";
            $data = null;
            $test_string = "";
            if ($request->search_bar == 'true') {
                $data = DB::table('donations')->where('nickname', 'like',  "%$request->name%")->orderBy('nickname', 'asc')->limit($limit)->get();
                // $last_points = '';

                if (!$data->isEmpty()) {
                    $left = true;
                    $test_string = "masuk search bar";
                    foreach ($data as $a) {
                        if ($left) {
                            $output .= "
                        <div class='container-leaderboard mt-4 bg-light text-left wow fadeInLeft'>\n";
                            $left = false;
                        } else {
                            $output .= "
                        <div class='container-leaderboard mt-4 bg-light text-left wow fadeInRight'>\n";
                            $left = true;
                        }
                        if ($a->trash_weights > 0 && $a->trash_weights < 100) {
                            $output .= "<img src='/Images/TIER 3.png' alt='' id='badge'>\n";
                        } elseif ($a->trash_weights > 100 && $a->trash_weights < 500) {
                            $output .= "<img src='/Images/TIER 2.png' alt='' id='badge'>\n";
                        } else {
                            $output .= "<img src='/Images/TIER 1.png' alt='' id='badge'>\n";
                        }
                        $output .= "
                            <div class='block-text-leaderboard' style=''>
                                <h3 id='nama-leaderboard'>$a->nickname</h3>
                                <h5 id='pesan-leaderboard'>$a->message
                                </h5>
                            </div>
                            <div class='block-text-right-leaderboard'>
                                <h3 class='leaderboard-amount'>
                                    <div id='leaderboard-amount' class='text-center'>
                                         $a->trash_weights kg
                                    </div>
                                </h3>
                            </div>
                        </div>
                            ";
                    }
                } else {
                    $output .= "
                    <div class='container-leaderboard mt-4 bg-light text-left wow fadeInLeft'>
                        <div class='block-text-leaderboard text-center' style=''>
                            <h3 id='nama-leaderboard'>Data not found !</h3>
                        </div>
                    </div>";
                }
            } else {
                if ($request->inner_one == 0) {
                    $data = DB::table('donations')->orderBy('created_at', 'desc')->limit($limit)->get();
                    // $data = Donation::orderBy('created_at', 'desc');
                    $test_string = "masuk inner 0";
                } else if ($request->inner_one == 1) {
                    $data = DB::table('donations')->orderBy('trash_weights', 'desc')->limit($limit)->get();
                    $test_string = "masuk inner 1";
                }

                if (!$data->isEmpty()) {
                    $left = true;
                    foreach ($data as $a) {
                        if ($left) {
                            $output .= "
                        <div class='container-leaderboard mt-4 bg-light text-left wow fadeInLeft'>\n";
                            $left = false;
                        } else {
                            $output .= "
                        <div class='container-leaderboard mt-4 bg-light text-left wow fadeInRight'>\n";
                            $left = true;
                        }
                        if ($a->trash_weights > 0 && $a->trash_weights < 100) {
                            $output .= "<img src='/Images/TIER 3.png' alt='' id='badge'>\n";
                        } elseif ($a->trash_weights > 100 && $a->trash_weights < 500) {
                            $output .= "<img src='/Images/TIER 2.png' alt='' id='badge'>\n";
                        } else {
                            $output .= "<img src='/Images/TIER 1.png' alt='' id='badge'>\n";
                        }
                        $output .= "
                            <div class='block-text-leaderboard' style=''>
                                <h3 id='nama-leaderboard'> $a->nickname</h3>
                                <h5 id='pesan-leaderboard'> $a->message
                                </h5>
                            </div>
                            <div class='block-text-right-leaderboard'>
                                <h3 class='leaderboard-amount'>
                                    <div id='leaderboard-amount' class='text-center'>
                                         $a->trash_weights kg
                                    </div>
                                </h3>
                            </div>
                        </div>
                            ";
                    }
                } else {
                    $output .= "
                    <div class='container-leaderboard mt-4 bg-light text-left wow fadeInLeft'>
                        <div class='block-text-leaderboard text-center' style=''>
                            <h3 id='nama-leaderboard'>Data not found !</h3>
                        </div>
                    </div>";
                }
            }

            $json = array(
                'output' => $output,
                // 'count' => $test_string,
                // 'bool' =>$request->search_bar,
            );

            // echo $output;
            echo json_encode($json);
        }

        // $json = array('table_data' => $output);
        // echo $output;
    }

    public function payPalPayment(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'message' => 'max:40',
                'nickname' => 'max:25'
            ]);
            $money = $request->rupiah;

            $kilogram = $money / 5000;
            // $points = (double)$request->amount;

            Donation::create([
                'user_id' => auth()->user()->id,
                'nickname' => $request->nickname,
                'message' => $request->message,
                'trash_weights' => $kilogram,
                'money_amount' => $money,
                'anonymous' => $request->anonymous,
            ]);

            $points = $kilogram * 100;

            $user_point = User::where('email', auth()->user()->email)->first();

            User::where('email', auth()->user()->email)->update([
                'points' => $user_point->points + $points,
            ]);

            echo "Donation successfully made !";
        }
    }
}
