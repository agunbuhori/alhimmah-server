<?php

$user = auth()->user();

$lang = $user->lang ?? 'id';
$translates = DB::table('translates')->where('language_code', $lang)->pluck('value', 'key');

return $translates;