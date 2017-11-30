<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Cms\CreateVersion;
use App\Http\Requests\Cms\UpdateVersion;
use App\Events\VersionCreated;

class Versions extends Controller
{
    public function index()
    {
      $versions = \App\Version::latest('updated_at')->get();
      return view('versions', compact('versions'));
    }

    public function versionDetails(\App\Version $version)
    {
      return $version;
    }

    public function store(CreateVersion $request)
    {
      $version = \App\Version::create($request->all());

      // Dispatch event to deactivate old versions, mark the newly
      // created version as active and notify users of the new version
      event(new VersionCreated($version));

      $versions = \App\Version::latest('updated_at')->get();
      return view('tables.versions_table', compact('versions'));
    }

    public function update(UpdateVersion $request, $id)
    {
      $version = \App\Version::updateOrCreate(compact('id'), $request->all());
      $versions = \App\Version::latest('updated_at')->get();
      return view('tables.versions_table', compact('versions'));
    }
}
