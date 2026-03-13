@extends('layouts.admin')

@section('title', 'Messages')
@section('page-title', '✉️ Messages')

@section('content')
<div class="card">
    <table>
        <thead>
            <tr>
                <th style="width:80px">Status</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
            <tr class="{{ !$msg->isRead() ? 'unread-row' : '' }}">
                <td>
                    @if($msg->isRead())
                        <span class="badge badge-green" style="font-size:.7rem">✔ Read</span>
                    @else
                        <span class="unread-dot"></span><span class="badge badge-purple" style="font-size:.7rem">New</span>
                    @endif
                </td>
                <td><strong>{{ $msg->name }}</strong></td>
                <td style="color:var(--text-muted);font-size:.85rem">{{ $msg->email }}</td>
                <td>{{ Str::limit($msg->subject, 35) }}</td>
                <td style="color:var(--text-muted);font-size:.8rem">{{ $msg->created_at->format('M d, Y') }}</td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-outline btn-sm">👁️ Read</a>
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:3rem">📭 No messages yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('styles')
<style>
.unread-row td { background: rgba(168,85,247,.04) !important; }
.unread-row td:first-child { border-left: 2px solid var(--accent-light); }
</style>
@endpush
@endsection
