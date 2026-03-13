@extends('layouts.admin')

@section('title', 'Edit Project')
@section('page-title', '✏️ Edit Project')

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-body">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST">
            @csrf @method('PUT')
            @if($errors->any())
                <div class="alert alert-danger">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>
            @endif
            <div class="form-group">
                <label>Project Title *</label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}" required>
            </div>
            <div class="form-group">
                <label>Description *</label>
                <textarea name="description" required>{{ old('description', $project->description) }}</textarea>
            </div>
            <div class="form-group">
                <label>Tech Stack * <span style="color:var(--text-muted);font-size:.75rem">(comma-separated)</span></label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack', $project->tech_stack) }}" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Image URL</label>
                    <input type="url" name="image_url" value="{{ old('image_url', $project->image_url) }}">
                </div>
                <div class="form-group">
                    <label>GitHub URL</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Live URL</label>
                    <input type="url" name="live_url" value="{{ old('live_url', $project->live_url) }}">
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}">
                </div>
            </div>
            <div class="form-group" style="display:flex;align-items:center;gap:.75rem">
                <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }} style="width:auto">
                <label for="featured" style="margin:0;text-transform:none;font-size:.9rem">Mark as Featured</label>
            </div>
            <div style="display:flex;gap:1rem;margin-top:1rem">
                <button type="submit" class="btn btn-primary">💾 Update Project</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
