<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home.index')->name('home.index');
Route::livewire('/blog', 'pages::blog.index')->name('blog.index');
Route::livewire('/login', 'pages::login.index')->name('login.index')->middleware('guest');
Route::livewire('/blog/post/{post:slug}', 'pages::blog.show')->name('blog.post.show');
