@extends('layouts.app')
@section('content')
@include('navbarAdmin')
<div class="container mt-4">
    <div class="text-center mb-4">
        <h1 class="display-6 fw-bold">Admin Chat Board</h1>
    </div>

    <div class="chat-box border rounded shadow-sm bg-light p-3 mb-3" 
         style="height: 400px; overflow-y: auto;">

        @forelse($messages as $message)
            @php
                $isMine = $message->admin_id == Auth::guard('admin')->id();
            @endphp

            <div class="d-flex mb-3 {{ $isMine ? 'justify-content-end' : 'justify-content-start' }}">
                @unless($isMine)
                    <img src="{{ $message->admin->profile_picture_url ?? 'https://via.placeholder.com/40' }}"
                         class="rounded-circle border me-2" width="40" height="40" alt="Admin Pic">
                @endunless

                <div>
                    <div class="mb-1 {{ $isMine ? 'text-end' : '' }}">
                        <strong class="{{ $isMine ? 'text-success' : 'text-primary' }}">
                            {{ $message->admin->name }}
                        </strong>
                        <small class="text-muted"
                               data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="{{ $message->created_at->format('Y-m-d H:i:s') }}">
                            · {{ $message->created_at->format('H:i') }}
                        </small>
                    </div>
                    <div class="p-2 rounded"
                         style="background-color: {{ $isMine ? '#d1e7dd' : '#fff' }}; border: 1px solid #ddd; max-width: 75%;">
                        {{ $message->content }}
                    </div>
                </div>

                @if($isMine)
                    <img src="{{ $message->admin->profile_picture_url ?? 'https://via.placeholder.com/40' }}"
                         class="rounded-circle border ms-2" width="40" height="40" alt="Admin Pic">
                @endif
            </div>
        @empty
            <div class="text-center text-muted">No messages yet. Start the conversation!</div>
        @endforelse
    </div>

    <form method="POST" action="{{ route('chat.store') }}">
        @csrf
        <div class="input-group">
            <textarea name="content" class="form-control" rows="1" placeholder="Type your message..." required></textarea>
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>

<style>
.chat-box {
    background: #f8f9fa;
}

textarea.form-control {
    resize: none;
}

.display-6 {
    font-size: 2rem;
}

@media (min-width: 768px) {
    .display-6 {
        font-size: 2.5rem;
    }
}
</style>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush
@endsection
