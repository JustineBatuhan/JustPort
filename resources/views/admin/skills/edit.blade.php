@extends('layouts.admin')

@section('title', 'Edit Skill')
@section('page-title', '✏️ Edit Skill')

@section('content')
<div class="card" style="max-width:500px">
    <div class="card-body">
        <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
            @csrf @method('PUT')
            @if($errors->any())
                <div class="alert alert-danger">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>
            @endif
            <div class="form-group">
                <label>Skill Name *</label>
                <input type="text" name="name" value="{{ old('name', $skill->name) }}" required>
            </div>
            <div class="form-group">
                <label>Category *</label>
                <select name="category" required>
                    <option value="Frontend" {{ old('category', $skill->category) === 'Frontend' ? 'selected' : '' }}>🎨 Frontend</option>
                    <option value="Backend"  {{ old('category', $skill->category) === 'Backend'  ? 'selected' : '' }}>⚙️ Backend</option>
                    <option value="Tools"    {{ old('category', $skill->category) === 'Tools'    ? 'selected' : '' }}>🛠️ Tools</option>
                </select>
            </div>
            <div class="form-group">
                <label>Proficiency Level (1–100) *</label>
                <input type="range" name="level" id="level-range" min="1" max="100" value="{{ old('level', $skill->level) }}" oninput="document.getElementById('level-val').textContent=this.value" style="width:100%;accent-color:var(--accent)">
                <div style="text-align:right;color:var(--accent-light);font-weight:700"><span id="level-val">{{ old('level', $skill->level) }}</span>%</div>
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order) }}">
            </div>
            <div style="display:flex;gap:1rem;margin-top:1rem">
                <button type="submit" class="btn btn-primary">💾 Update Skill</button>
                <a href="{{ route('admin.skills.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
