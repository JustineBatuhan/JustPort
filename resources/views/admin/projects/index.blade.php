@extends('layouts.admin')

@section('title', 'Projects')
@section('page-title', '💡 Projects')
@section('topbar-actions')
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">➕ Add Project</a>
@endsection

@section('content')
<div class="card">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Tech Stack</th>
                <th>Featured</th>
                <th>Links</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td style="color:var(--text-muted)">{{ $project->id }}</td>
                <td><strong>{{ $project->title }}</strong></td>
                <td style="color:var(--text-muted);font-size:.8rem">{{ Str::limit($project->tech_stack, 40) }}</td>
                <td>
                    @if($project->featured)
                        <span class="badge badge-purple">⭐ Yes</span>
                    @else
                        <span style="color:var(--text-muted)">—</span>
                    @endif
                </td>
                <td>
                    @if($project->github_url) <a href="{{ $project->github_url }}" target="_blank" style="color:var(--accent-light);font-size:.8rem">GitHub</a> @endif
                    @if($project->live_url)   <a href="{{ $project->live_url }}"   target="_blank" style="color:var(--cyan);font-size:.8rem;margin-left:.5rem">Live</a> @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-outline btn-sm">✏️ Edit</a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">No projects yet. <a href="{{ route('admin.projects.create') }}" style="color:var(--accent-light)">Add one!</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
