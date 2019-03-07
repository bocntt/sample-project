<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\AuthTraits\OwnsRecord;
use App\Lesson;
use Redirect;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\UnauthorizedException;
use App\Category;
use App\Subcategory;

class LessonController extends Controller
{
    use OwnsRecord;

    public function __construct() {
        $this->middleware('auth', ['except' => 'index']);
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lesson.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        $subcategories = Subcategory::all();

        return view('lesson.create', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\LessonCreateRequest $request)
    {

        $slug = str_slug($request->name, "-");

        $widget = Lesson::create([
            'name' => $request->name,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id
        ]);

        $widget->save();

        alert()->success('Congrat!', 'You made a Lesson');

        return Redirect::route('lesson.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson, $slug = '')
    {
        if ($lesson->slug != $slug) {
            return Redirect::route('lesson.show', [
                'id' => $lesson->id,
                'slug' => $lesson->slug
            ], 301);
        }

        return view('lesson.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        if (! $this->adminOrCurrentUserOwns($lesson)) {
            throw new UnauthorizedException;
        }

        $category = Category::where('id', $lesson->category_id)->first();

        $subcategory = Subcategory::where('id', $lesson->subcategory_id)
                        ->first();

        list($categories, $subcategories) = $this->getCategoryLists();

        return view('lesson.edit', compact("lesson",
                                            "category",
                                            'subcategory',
                                            'categories',
                                            'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $this->validate($request, [
            'name' => 'required|string|max:40|unique:widgets,name,' . $lesson->id,
            'category_id' => 'required|numeric|isValidCategory',
            'subcategory_id' => 'required|belongsToCategory'
        ]);

        if (! $this->adminOrCurrentUserOwns($lesson)) {
            throw new UnauthorizedException;
        }

        $slug = str_slug($request->name, "-");

        $lesson->update([
            'name' => $request->name,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id
        ]);

        alert()->success('Congrat!', 'You updated a lesson');

        return Redirect::route('lesson.show', [
            'lesson' => $lesson,
            'slug' => $slug
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lesson::destroy($id);

        alert()->overlay("Attention!", 'You deleted a lesson', 'error');

        return Redirect::route('lesson.index');
    }

    private function getCategoryLists() {
        $categories = Category::all();

        $subcategories = Subcategory::all();

        return [$categories, $subcategories];
    }
}
