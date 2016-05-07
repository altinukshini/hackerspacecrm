<?php

namespace HackerspaceCRM\Menu;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'permission',
        'menu_group',
        'menu_order',
        'title',
        'url',
        'description',
        'icon',
    ];

    /**
     * When model updated, touch parent (update timestamp)
     *
     * @var array
     */
    protected $touches = ['parent'];

    /**
     * Relation between this menu and its parents.
     *
     * @return Menu
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Relation between this menu and its children.
     *
     * @return Menu
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('menu_order', 'asc');
    }

    /**
     * Check if menu has children
     *
     * @return bool
     */
    public function hasChildren()
    {
        return $this->children ? true : false;
    }

    /**
     * Check if menu has parent
     *
     * @return bool
     */
    public function hasParent()
    {
        return $this->parent ? true : false;
    }
}
