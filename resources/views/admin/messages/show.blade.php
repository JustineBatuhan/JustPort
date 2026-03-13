@extends('layouts.admin')

@section('title', 'Message')
@section('page-title', '📨 Message Detail')

@section('content')
<div class="card" style="max-width:680px">
    {{-- Sender Header --}}
    <div class="card-header" style="background:linear-gradient(90deg,rgba(124,58,237,.08),transparent);gap:1rem;flex-wrap:wrap;">
        <div style="display:flex;align-items:center;gap:1rem">
            <div style="width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--cyan));display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;">
                {{ strtoupper(substr($message->name, 0, 1)) }}
            </div>
            <div>
                <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:1px;color:var(--text-muted)">From</div>
                <strong style="font-size:1rem">{{ $message->name }}</strong>
                <span style="color:var(--text-muted);font-size:.85rem"> &lt;{{ $message->email }}&gt;</span>
            </div>
        </div>
        <div style="text-align:right">
            <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:1px;color:var(--text-muted)">Received</div>
            <div style="font-weight:500;font-size:.875rem">{{ $message->created_at->format('F d, Y') }}</div>
            <div style="color:var(--text-muted);font-size:.8rem">{{ $message->created_at->format('h:i A') }}</div>
        </div>
    </div>

    <div class="card-body">
        {{-- Subject --}}
        <div style="margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid var(--border)">
            <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:1px;color:var(--text-muted);margin-bottom:.4rem">Subject</div>
            <div style="font-size:1.15rem;font-weight:700">{{ $message->subject }}</div>
        </div>

        {{-- Message Body --}}
        <div>
            <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:1px;color:var(--text-muted);margin-bottom:.75rem">Message</div>
            <div style="background:rgba(255,255,255,.03);border:1px solid var(--border);border-left:3px solid var(--accent-light);border-radius:8px;padding:1.5rem;line-height:1.9;color:var(--text-primary);font-size:.95rem">
                {!! nl2br(e($message->body)) !!}
            </div>
        </div>

        {{-- Actions --}}
        <div style="display:flex;gap:1rem;margin-top:1.75rem;flex-wrap:wrap">
            <a href="mailto:{{ $message->email }}" class="btn btn-primary">📧 Reply via Email</a>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline">← Back to Messages</a>
            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️ Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
