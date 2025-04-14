<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Query;
use App\Models\Chat;
use App\Models\User;
use App\Models\Team;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Project;
use App\Models\InvoiceItem;

class HomeController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalInvoices = Invoice::count();
        $totalProducts = Product::count();
        $totalProjects = Project::count();
        $totalTeams = Team::count();
        $totalAmounts = Invoice::sum('total_amount');
        return view('index',compact('totalUsers','totalInvoices', 'totalProducts', 'totalProjects','totalTeams','totalAmounts'));
    }

    public function dashboard_two()
    {
        return view('dashboard.dashboard_two');
    }

    public function dashboard_three()
    {
        return view('dashboard.dashboard_three');
    }
    // forms
    public function general_form()
    {
        return view('forms.general_form');
    }

    public function advanced()
    {
        return view('forms.advanced');
    }

    public function validation()
    {
        return view('forms.validation');
    }

    public function wizard()
    {
        return view('forms.wizard');
    }

    public function uploads()
    {
        return view('forms.uploads');
    }

    public function buttons()
    {
       return view('forms.buttons');
    }

    // UI elements

    public function general_elements()
    {
        return view('elements.general_elements');
    }

    public function media_gallery()
    {
        return view('elements.media_gallery');
    }

    public function typography()
    {
        return view('elements.typography');
    }
    public function icons()
    {
        return view('elements.icons');
    }

    public function glyphicons()
    {
        return view('elements.glyphicons');
    }

    public function widgets()
    {
        return view('elements.widgets');
    }

    public function invoice()
    {
        return view('elements.invoice');
    }

    public function inbox()
    {
        return view('elements.inbox');
    }

    public function calender()
    {
        return view('elements.calender');
    }

    // table
    public function table()
    {
        return view('tables.table');
    }

    public function table_dynamic()
    {
        return view('tables.table-dynamic');
    }

    // data presentation

    public function chart_js()
    {
        return view('data-presentation.chart_js');
    }
    public function chart_js_two()
    {
        return view('data-presentation.chart_js_two');
    }

    public function moris_js()
    {
        return view('data-presentation.moris_js');
    }

    public function echarts()
    {
        return view('data-presentation.echarts');
    }

    public function other_charts()
    {
        return view('data-presentation.other_charts');
    }

    //layouts

    public function fixed_sidebar()
    {
        return view('layout.fixed_sidebar');
    }

    public function fixed_footer()
    {
        return view('layout.fixed_footer');
    }

    // additional pages

    public function e_commerce()
    {
        return view('additional_pages.e_commerce');
    }



    public function project_detail()
    {
        return view('additional_pages.project_detail');
    }

    
    public function profiles()
    {
        $user = Auth::guard('web')->check() ? Auth::guard('web')->user() : Auth::guard('user')->user();

        if (!$user) {
            return redirect()->route('login')->withErrors('User not authenticated');
        }

        $teamLead = User::Where('id', $user->team_lead_id)->first();

        $members = [];
        if ($teamLead) {
            $teamMemberIds = explode(',', $team->team_members);
            $members = User::whereIn('id', $teamMemberIds)->get();
        }
        return view('additional_pages.profiles', compact('user','teamLead', 'members'));
    }

    public function createTeam($id)
    {
        $teamLead = User::find($id);

        if(!$teamLead || !$teamLead->is_team_lead)
        {
            return redirect()->back()->with('error','invalid team lead');
        }
        $assignedIds = collect(Team::pluck('team_members'))
        ->filter()
        ->flatMap(function ($memberString) {
            return explode(',', $memberString);
        })
        ->unique()
        ->toArray();

        $users = User::where('role', 'user')
                  ->where('is_team_lead', '!=', 1)
        ->whereNotIn('id', $assignedIds)
        ->get();
        
        // dd($users);

        return view('team.create', compact('teamLead', 'users'));
    }

    public function storeTeam(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'team_name' => 'required|string|max:255',
            'team_lead_id' => 'required|exists:users,id',
            'team_members' => 'required|array',
            'team_members.*' => 'exists:users,id'
        ]);

        $teamMembersString = implode(',', $request->team_members);

        //dd($teamMembersString);
        $team = Team::create([
            'team_name' => $request->team_name,
            'team_lead_id' => $request->team_lead_id,
            'team_members' => $teamMembersString,
        ]);

        $team->save();
        
        return redirect()->route('profiles', $request->team_lead_id)->with('success', 'Team created successfully');
    }


    public function showTeam($id)
    {
        $teamLead = User::find($id);
        if(!$teamLead || !$teamLead->is_team_lead)
        {
            return redirect()->back()->with('error','invalid team lead');
        }
        $team = Team::where('team_lead_id', $id)->first();
        if(!$team)
        {
            return redirect()->back()->with('error','No Team Found');
        }
        $teamMembers = explode(',', $team->team_members);
        $teamMembers = User::whereIn('id', $teamMembers)->get();
         //dd($teamMembers);
        return view('team.my_team', compact('teamLead', 'teamMembers'));
    }

    public function addMember($id)
    {
        $teamLead = User::find($id);
        if(!$teamLead || !$teamLead->is_team_lead)
        {
            return redirect()->back()->with('error','invalid team lead');
        }
        $assignIds = collect(Team::pluck('team_members'));
        $assignIds = $assignIds->filter()
        ->flatmap(function ($memberString){
            return explode(',', $memberString);
        });
        $assignIds = $assignIds->unique()->toArray();
        $users = User::where('role', 'user')
        ->where('is_team_lead', '!=', 1)
        ->whereNotIn('id', $assignIds)
        ->get();
    }


    // extras

    public function error403()
    {
        return view('extras.403_error');
    }

    public function error404()
    {
        return view('extras.404_error');
    }

    public function error500()
    {
        return view('extras.505_error');
    }

    public function plain_page()
    {
        return view('extras.plain_page');
    }

    public function login_page()
    {
        return view('extras.login_page');
    }
    
    public function pricing_tables()
    {
        return view('extras.pricing_tables');
    }

    public function queryForm()
    {
        return view('query');
    }

    public function querySubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'query' => 'required|max:255',
            
        ]);

        Query::create([
            'name' => $request->input('name'),
            'query' => $request->input('query'),
            'email' => $request->input('email'),
        ]);
        return redirect()->back()->with('success', 'query submitted successfully');
    }

    public function queryList()
    {
        $user = Auth::guard('user')->user();
        $queries = Chat::with('user')
        ->where(function($query) use ($user) {
            $query->where('receiver_id', 9)
                  ->where('user_id', $user->id);
        })
        ->orWhere(function($query) use ($user) {
            $query->where('receiver_id', $user->id)
                  ->where('user_id', 9);
        })
        ->get();
        return view('query_list', compact('queries'));
    }
    

    public function showQuery()
    {
        $keyword = request()->query('keyword');
        if($keyword){
            $users = Chat::with('user')->select('user_id')->where('user_id', '!=', Auth::guard('web')->user()->id)->whereHas('user', function($query) use($keyword){
                $query->where('name', 'like', "%$keyword%");
                $query->orWhere('email', 'like', "%$keyword%");
            })->groupBy('user_id')->get();
        }else{
            $users = Chat::with('user')->select('user_id')->where('user_id', '!=', Auth::guard('web')->user()->id)->groupBy('user_id')->get();
        }
        return view('show_query', compact('users'));
    }

    public function admin_chat($id)
    {
        $admin = Auth::guard('web')->user();
        // dd($admin);
        // $chats = Chat::with('user')
        // ->whereIn('user_id',  [$id, $admin->id])
        // ->where('receiver_id',$admin->id)
        // ->orderBy('id','DESC')
        // ->get();
        // dd($chats);

        $chats = DB::table('chats')
        ->where(function($query) use ($id, $admin) {
            $query->where('user_id', $id)
                ->where('receiver_id', $admin->id);
        })
        ->orWhere(function($query) use ($id, $admin) {
            $query->where('user_id', $admin->id)
                ->where('receiver_id', $id);
        })
        ->get();
        // dd($chats);
        $user = User::find($id);
        // dd($user);
        return view('admin_chat', compact('chats', 'user'));
    }

    public function send_message(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'user_id' => 'required|integer',
        ]);

        $admin = Auth::guard('web')->user();

        Chat::create([
            'user_id' => $admin->id,
            'receiver_id' => $request->input('user_id'),
            'message' => $request->message,
            'sender' => 'admin',
        ]);
        return redirect()->route('admin_chat', $request->user_id)->with('success', 'message sent successfully');
    }
    public function user_send_message(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'user_id' => 'required|integer',
        ]);

        $user = Auth::guard('user')->user();

        Chat::create([
            'user_id' => $user->id,
            'receiver_id' => $request->input('user_id'),
            'message' => $request->message,
            'sender' => 'user',
        ]);
        return redirect()->route('query_list')->with('success', 'message sent successfully');
    }

    public function getUserMessages()
    {
        if(Auth::guard('web')->check()){
            $adminId = 9;
            
            $userMessageCount = Chat::where('receiver_id', $adminId)
                                    ->where('sender','user')
                                    ->distinct('user_id')
                                    ->count('user_id');

            $messages = Chat::where('receiver_id', $adminId)
                                    ->where('sender','user')
                                    ->with('user')
                                    ->latest()
                                    ->limit(4)
                                    ->get();
                //dd($messages->toArray());
            //    dd($userMessageCount, $messages);

         return view('index',compact('userMessageCount','messages'));
        }
    }

    public function contacts()
    {
        
        $keyword = request()->query('keyword');
        if ($keyword) {
            $users = User::where('role', 'user')
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
                  ->orWhere('phone', 'like', "%$keyword%")
                  ->orWhere('address', 'like', "%$keyword%")
                  ->orWhere('about', 'like', "%$keyword%")
                  ->orWhere('designation', 'like', "%$keyword%")
                  ->orWhere('specialization', 'like', "%$keyword%")
                  ->orWhere('email', 'like', "%$keyword%");
            })
            ->get();
        } else {
            $users = User::where('role', 'user')->get();
        }
        return view('contacts', compact('users'));
    }

    public function view_profile($id)
    {
        $user = User::where('role' , 'user')->where('id', $id)->first();

        if(!$user)
        {
            return redirect()->back->with('error', 'user not found');
        }
        
        return view('admin.view_profile', compact('user'));
    }

    public function toggleTeamLead($id)
    {
        $user = User::find($id);
        
        if($user)
        {
            if($user->is_team_lead)
            {
                $user->is_team_lead = 0;
                $user->team_lead_id = null;
                $message = 'User has been removed from team lead';
            }else{
                $user->is_team_lead = 1;
                $user->team_lead_id = null;
                $message = 'User has been assigned as a team lead';
            }
            $user->save();
            return redirect()->back()->with('success', $message);
        }
        return redirect()->back()->with('error', 'user not found');
    } 
}
