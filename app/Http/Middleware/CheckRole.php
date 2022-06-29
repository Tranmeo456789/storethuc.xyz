<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {    
        $RolePage=0;$RolePost=0;$RoleProduct=0;$RoleOrder=0;$RoleUser=0;  
        if(Auth::check()) {
            $roles= User::find(Auth::id())->roles;
        foreach($roles as $role){
           if($role->name == 'RolePage'){
                $RolePage=1;      
           }
           if($role->name == 'RolePost'){
                $RolePost=1; 
                     
            } 
           if($role->name == 'RoleProduct'){
                 $RoleProduct=1;  
                     
            }
            if($role->name == 'RoleOrder'){
                $RoleOrder=1;      
           }   
           if($role->name == 'RoleUser'){
            $RoleUser=1;      
       }             
        }
        if( $RolePage==1 || $RolePost==1 || $RoleProduct==1 || $RoleOrder==1 || $RoleUser==1){
            return redirect('dashboard');
          
        }
        else{
            return redirect()->route('home');
        }
        }
        

        return $next($request);
    }
}
