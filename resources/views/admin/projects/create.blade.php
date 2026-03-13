@extends('layouts.admin')

@section('title', 'Add Project')
@section('page-title', '➕ Add Project')

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-body">
        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>
            @endif
            <div class="form-group">
                <label>Project Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Library Management System">
            </div>
            <div class="form-group">
                <label>Description *</label>
                <textarea name="description" required placeholder="Describe what this project does...">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label>Tech Stack * <span style="color:var(--text-muted);font-size:.75rem">(comma-separated)</span></label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack') }}" required placeholder="PHP, Laravel, MySQL, HTML, CSS">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Image URL</label>
                    <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="https://...">
                </div>
                <div class="form-group">
                    <label>GitHub URL</label>
                    <input type="url" name="github_url" value="{{ old('github_url') }}" placeholder="https://github.com/...">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Live URL</label>
                    <input type="url" name="live_url" value="{{ old('live_url') }}" placeholder="https://...">
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}">
                </div>
            </div>
            <div class="form-group" style="display:flex;align-items:center;gap:.75rem">
                <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }} style="width:auto">
                <label for="featured" style="margin:0;text-transform:none;font-size:.9rem">Mark as Featured Project</label>
            </div>
            <div style="display:flex;gap:1rem;margin-top:1rem">
                <button type="submit" class="btn btn-primary">💾 Save Project</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
