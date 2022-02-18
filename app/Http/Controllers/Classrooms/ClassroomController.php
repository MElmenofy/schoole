<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        $classes = Classroom::all();
        return view('pages.classrooms.classrooms', compact('classes', 'grades'));

    }

    public function filter_classes(Request $request)
    {
        $grades = Grade::all();
        $search = Classroom::select('*')->where('grade_id', $request->grade_id)->get();
        return view('pages.classrooms.classrooms', compact( 'grades'))->withDetails($search);
    }

    public function create()
    {
        //
    }


    public function store(ClassroomRequest $request)
    {
        $validated = $request->validated();
        $list_classes = $request->list_classes;
        try {
            foreach ($list_classes as $list_class) {
                $my_class = new Classroom();
                $my_class->name_class = ['en' => $list_class['name_class_en'], 'ar' => $list_class['name']];
                $my_class->grade_id = $list_class['grade_id'];
                $my_class->save();
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('classrooms.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function show(Classroom $classroom)
    {
        //
    }


    public function edit(Classroom $classroom)
    {
        //
    }


    public function update(ClassroomRequest $request)
    {
        $classrooms = Classroom::findOrFail($request->id);
        $classrooms->update([
           $classrooms->name_class = ['ar' => $request->name, 'en' =>$request->name_en],
            $classrooms->grade_id = $request->grade_id,
        ]);
        toastr()->success(__('messages.Update'));
        return redirect()->route('classrooms.index');
    }


    public function destroy(Request $request)
    {
        $classrooms = Classroom::findOrFail($request->id)->delete();
        toastr()->error(__('messages.Delete'));
        return redirect()->route('classrooms.index');
    }

    public function c_delete_all(Request $request)
    {
        $delete_all_id = explode(',', $request->delete_all_id);
        $classrooms = Classroom::whereIn('id', $delete_all_id)->delete();
        toastr()->error(__('messages.Delete'));
        return redirect()->route('classrooms.index');
    }


}
