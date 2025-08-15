<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Notifications\NewLessonNotification;
use App\Lesson;
use App\User;
class LessonController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function newLesson(){
        $lesson = new Lesson;
        $lesson->user_id = auth()->user()->id;
        $lesson->title = 'Laravel Notification';
        $lesson->body = 'This is lesson we learn about notification on laravel';
        $lesson->save();
        $user = User::where('id','!=', auth()->user()->id)->get();
        if(\Notification::send($user, new NewLessonNotification(Lesson::latest('id')->first())))
        {
            return back();
        }
    }
    public function markAsRead(Request $r){
        auth()->user()->unreadNotifications->find($r->not_id)->markAsRead();
    }

    public function readLesson($lesson_id){
        $lesson = Lesson::find($lesson_id);
        return view ('BS.home', compact('lesson'));
    }
    public function readAllLesson(){
        $lesson = auth()->user()->readNotifications;
        return view('BS.home', compact('lessons'));
    }
    public function allMarkAsRead(){
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }
  
}
