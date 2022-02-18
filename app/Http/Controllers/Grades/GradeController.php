<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::get();
        return view('pages.grades.grades', compact('grades'));
    }

    public function create()
    {
        //
    }

    public function store(GradeRequest $request)
    {
//        if (Grade::where('name->ar', $request->name)->orWhere('name->en', $request->name_en)->exists()){
//            return redirect()->back()->withErrors(__('grades_trans.exists'));
//        }
        try {
            $validated = $request->validated();
            $grade = new Grade();
            $grade->name = ['en' => $request->name_en, 'ar' => $request->name];
            $grade->notes = $request->notes;
            $grade->save();
            toastr()->success(__('messages.success'));
            return redirect()->route('grades.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

    }

    public function show(Grade $grade)
    {
        //
    }

    public function update(GradeRequest $request)
    {
        try {
        $validated = $request->validated();
        $grade = Grade::findOrFail($request->id);
        $grade->update([
            $grade->name = ['en' => $request->name_en, 'ar' => $request->name],
            $grade->notes = $request->notes
        ]);
        toastr()->success(trans('messages.Update'));
        return redirect()->route('grades.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $myclass_id = Classroom::where('grade_id', $request->id)->pluck('grade_id');
        if ($myclass_id->count() == 0){
            $grade = Grade::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('grades.index');
        }else{
            toastr()->error(trans('messages.error'));
            return redirect()->route('grades.index');
        }
    }
}
