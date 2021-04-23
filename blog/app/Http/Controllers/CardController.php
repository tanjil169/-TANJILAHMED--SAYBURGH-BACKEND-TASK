<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Card;
use File;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::get();
        // return $cards;
        return view('sections.card-index', compact('cards'));
    }

    
    public function show($id)
    {

    }

    public function create()
    {
        return view('sections.card-create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|max:5120|mimes:jpg,png,jpeg',
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $image = 'card-image_' . rand(0, 99999) . '_' . date("Y-m-d") . '.' . $extension;
            $request->image->move(public_path("uploads/image"), $image);
        } else {
            $image = null;
        }

        Card::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
        ]);

        return redirect(route('card.index'))->with('success', 'Card created successfully');
    }

    public function update(Request $request, $id)
    {

        $card = Card::findOrFail($id);

        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $image = 'card-image_' . rand(0, 99999) . '_' . date("Y-m-d") . '.' . $extension;
            $request->image->move(public_path("/uploads/image"), $image);

            if (File::exists(public_path("uploads/image/$card->image"))) {
                File::delete(public_path("uploads/image/$card->image"));
            }

            $card->image = $image;
        }

        $card->title = $request->title;
        $card->description = $request->description;

        $card->save();

        return redirect()->back()->with('success', 'Post has been updated.');
    }

    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        if (File::exists(public_path("uploads/image/$card->image"))) {
            File::delete(public_path("uploads/image/$card->image"));
        }
        $card->delete();
        return redirect()->back()->with('success', 'Card has been deleted.');
    }

    public function home()
    {
        $cards = Card::get();
        return view('homepage', compact('cards'));
    }

    public function postDetails($id)
    {
        $post = Card::findOrFail($id);
       // return $post;
        return view('sections.post-details', compact('post'));
    }


}
