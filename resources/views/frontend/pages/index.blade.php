@extends('frontend.layouts.app')

@section('title'){{ $page->seo_title }}@endsection
@section('meta_description'){{ $page->seo_description }}@endsection
@section('meta_keywords'){{ $page->seo_keyword }}@endsection

@section('content')
    {!! $page->description !!}                    
@endsection