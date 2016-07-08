@extends('layouts.master')
{{--Title--}}
@section('title')
    Trending Quotes
@endsection

{{--Styles--}}
@section('styles')
    <script rel="stylesheet" src="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"></script>
@endsection

{{--Content--}}
@section('content')

    @if(count($errors) > 0)
        <section class="info-box fail">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </section>
    @endif

    @if(Session::has('success'))
        <section class="info-box success">
            {{Session::get('success')}}
        </section>
    @endif
    {{--Display quotes--}}
    <section class="quotes">
        <h1>Latest Quote</h1>
        @for($i = 0; $i < count($quotes); $i++)
            {{--{{ $i % 3 === 0 ? 'first-in-line' : ($i + 1) % 3 === 0 ? 'last-in0line': '' }} todo use this condition--}}
        <article class="quote">
            <div class="delete"><a href="{{ route('delete', ['quote_id' => $quotes[$i]->id]) }}">X</a></div>
                {{ $quotes[$i]->quote }}
            <div class="info">Created By <a href="#">{{ $quotes[$i]->author->name }}</a> on {{ $quotes[$i]->created_at }}</div>
        </article>
        @endfor
        <div class="pagination">
            Pagination
        </div>

    </section>
    {{--Quate editor--}}
    <section class="quotes">
        <h1>Add a Quote</h1>

        <form method="post" action="{{ route('new') }}">
            <div class="input-group">
                <label for="author">Yor name</label>
                <input type="text" name="author" id="author" placeholder="Your Name">
            </div>
            <div class="input-group">
                <label for="quote">Yor Quote</label>
                <textarea name="quote" id="quote" rows="5" placeholder="Your Quote">

                </textarea>
            </div>
            <button type="submit" class="btn">Submit</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </section>

@endsection