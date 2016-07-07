<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;

use Illuminate\Http\Request;

Class QuoteController extends Controller
{
    public function getIndex(){
        $quotes = Quote::all();
        return view('index', ['quotes' => $quotes]);
    }

    public function postQuote(Request $request){
        $authorText = ucfirst($request['author']);
        $quoteText = $request['quote'];

        //See if the author exist or create a new author
        $author =  Author::where('name', $authorText)->first();
        if(!$author){
            $author = new Author();
            $author->name = $authorText;
            $author->save();
        }

        //Add Quote for the author retrieved or new created
        $quote = new Quote();
        $quote->quote = $quoteText;
        $author->quote()->save($quote);

        //redirect to index route with success message
        return redirect()->route('index')->with([
            'success' => 'Quote Saved!'
        ]);

    }

}