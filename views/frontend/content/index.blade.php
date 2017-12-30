<?php
$url = app('Flarum\Http\UrlGenerator');
?>
<div class="container">
    <h2>{{ $translator->trans('core.views.index.all_discussions_heading') }}</h2>

    <ul>
        @foreach ($document->data as $discussion)
            <li>
<<<<<<< HEAD:views/index.blade.php
                <a href="{{ $url->toRoute('discussion', [
                    'id' => $discussion->id
=======
                <a href="{{ $url->to('forum')->route('discussion', [
                    'id' => $discussion->id . '-' . $discussion->attributes->slug
>>>>>>> d807171c445209b2375551b00972491346467d35:views/frontend/content/index.blade.php
                ]) }}">
                    {{ $discussion->attributes->title }}
                </a>
            </li>
        @endforeach
    </ul>

    <a href="{{ $url->to('forum')->route('index') }}?page={{ $page + 1 }}">{{ $translator->trans('core.views.index.next_page_button') }} &raquo;</a>
</div>
