<?php

/*
 * This file is part of SeAT
 *
 * Copyright (C) 2015 to 2020 Leon Jacobs
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace Seat\Eveapi\Models\Bookmarks;

use Illuminate\Database\Eloquent\Model;
use Seat\Eveapi\Models\Sde\SolarSystem;
use Seat\Eveapi\Traits\CanUpsertIgnoreReplace;

/**
 * Class CharacterBookmark.
 * @package Seat\Eveapi\Models\Assets
 *
 * @OA\Schema(
 *     description="Character Bookmark",
 *     title="CharacterBookmark",
 *     type="object"
 * )
 *
 * @OA\Property(
 *     type="integer",
 *     format="int64",
 *     property="bookmark_id",
 *     description="The bookmark identifier"
 * )
 *
 * @OA\Property(
 *     type="integer",
 *     format="int64",
 *     property="folder_id",
 *     description="The folder ID into which the bookmark resides"
 * )
 *
 * @OA\Property(
 *     type="string",
 *     property="folder_name",
 *     description="The folder name into which the bookmark resides"
 * )
 *
 * @OA\Property(
 *     property="system",
 *     ref="#/components/schemas/MapDenormalize"
 * )
 *
 * @OA\Property(
 *     type="string",
 *     format="date-time",
 *     property="created",
 *     description="The bookmark creation date"
 * )
 *
 * @OA\Property(
 *     type="string",
 *     property="label",
 *     description="The bookmark label"
 * )
 *
 * @OA\Property(
 *     type="string",
 *     property="notes",
 *     description="A note attached to the bookmark"
 * )
 *
 * @OA\Property(
 *     type="integer",
 *     property="location_id",
 *     description="The system ID where the bookmark is"
 * )
 *
 * @OA\Property(
 *     type="integer",
 *     format="int64",
 *     property="creator_id",
 *     description="The character who created the bookmark"
 * )
 *
 * @OA\Property(
 *     type="integer",
 *     format="int64",
 *     property="item_id",
 *     description="The in-game item on which the bookmark has been took"
 * )
 *
 * @OA\Property(
 *     type="integer",
 *     property="type_id",
 *     description="The type of them item"
 * )
 *
 * @OA\Property(
 *     type="number",
 *     format="double",
 *     property="x",
 *     description="The x position on the map"
 * )
 *
 * @OA\Property(
 *     type="number",
 *     format="double",
 *     property="y",
 *     description="The y position on the map"
 * )
 *
 * @OA\Property(
 *     type="number",
 *     format="double",
 *     property="z",
 *     description="The z position on the map"
 * )
 *
 * @OA\Property(
 *     type="integer",
 *     format="int64",
 *     property="map_id",
 *     description="The map to which the bookmark is referencing"
 * )
 */
class CharacterBookmark extends Model
{
    use CanUpsertIgnoreReplace;

    /**
     * @var bool
     */
    protected static $unguarded = true;

    /**
     * @var string
     */
    protected $primaryKey = 'bookmark_id';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function folder()
    {

        return $this->belongsTo(CharacterBookmarkFolder::class, 'folder_id')
            ->withDefault([
                'name'      => 'None',
            ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function solar_system()
    {
        return $this->hasOne(SolarSystem::class, 'system_id', 'location_id');
    }
}
