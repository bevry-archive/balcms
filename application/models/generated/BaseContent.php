<?php

/**
 * BaseContent
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $title
 * @property string $description
 * @property string $description_rendered
 * @property string $authorstr
 * @property string $tagstr
 * @property string $content
 * @property string $content_rendered
 * @property integer $avatar_id
 * @property integer $route_id
 * @property integer $parent_id
 * @property integer $position
 * @property timestamp $send_at
 * @property timestamp $send_finished_at
 * @property integer $send_all
 * @property integer $send_remaining
 * @property enum $send_status
 * @property enum $type
 * @property timestamp $event_start_at
 * @property timestamp $event_finish_at
 * @property Media $Avatar
 * @property Route $Route
 * @property Content $Parent
 * @property Doctrine_Collection $Subscribers
 * @property Doctrine_Collection $Children
 * @property Doctrine_Collection $ContentAndSubscriber
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6716 2009-11-12 19:26:28Z jwage $
 */
abstract class BaseContent extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('content');
        $this->hasColumn('id', 'integer', 4, array(
             'primary' => true,
             'type' => 'integer',
             'unsigned' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('code', 'string', 30, array(
             'type' => 'string',
             'notblank' => true,
             'unique' => true,
             'length' => '30',
             ));
        $this->hasColumn('title', 'string', 50, array(
             'type' => 'string',
             'notblank' => true,
             'length' => '50',
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'notblank' => true,
             'extra' => 
             array(
              'html' => 'rich',
             ),
             ));
        $this->hasColumn('description_rendered', 'string', null, array(
             'type' => 'string',
             'notblank' => true,
             'extra' => 
             array(
              'html' => 'rich',
             ),
             ));
        $this->hasColumn('authorstr', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             'length' => '50',
             ));
        $this->hasColumn('tagstr', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '',
             'length' => '255',
             ));
        $this->hasColumn('content', 'string', null, array(
             'type' => 'string',
             'notblank' => true,
             'extra' => 
             array(
              'html' => 'rich',
             ),
             ));
        $this->hasColumn('content_rendered', 'string', null, array(
             'type' => 'string',
             'notblank' => true,
             'extra' => 
             array(
              'html' => 'rich',
             ),
             ));
        $this->hasColumn('avatar_id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => true,
             'length' => '4',
             ));
        $this->hasColumn('route_id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => true,
             'unique' => true,
             'length' => '4',
             ));
        $this->hasColumn('parent_id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => true,
             'length' => '4',
             ));
        $this->hasColumn('position', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'notnull' => true,
             'default' => 0,
             'length' => '2',
             ));
        $this->hasColumn('send_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('send_finished_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('send_all', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => '4',
             ));
        $this->hasColumn('send_remaining', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 0,
             'length' => '4',
             ));
        $this->hasColumn('send_status', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'none',
              1 => 'pending',
              2 => 'completed',
             ),
             'default' => 'none',
             'notblank' => true,
             ));
        $this->hasColumn('type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'content',
              1 => 'event',
             ),
             'default' => 'content',
             'notblank' => true,
             ));
        $this->hasColumn('event_start_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('event_finish_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));

        $this->setSubClasses(array(
             'Event' => 
             array(
              'type' => 'event',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Media as Avatar', array(
             'local' => 'avatar_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Route', array(
             'local' => 'route_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Content as Parent', array(
             'local' => 'parent_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Subscriber as Subscribers', array(
             'refClass' => 'ContentAndSubscriber',
             'local' => 'content_id',
             'foreign' => 'subscriber_id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Content as Children', array(
             'local' => 'id',
             'foreign' => 'parent_id'));

        $this->hasMany('ContentAndSubscriber', array(
             'local' => 'id',
             'foreign' => 'content_id'));

        $softdelete0 = new Doctrine_Template_SoftDelete();
        $balauditable0 = new BalAuditable(array(
             'status' => 
             array(
              'disabled' => false,
             ),
             'enabled' => 
             array(
              'disabled' => false,
             ),
             'author' => 
             array(
              'disabled' => false,
             ),
             'created_at' => 
             array(
              'disabled' => false,
             ),
             'updated_at' => 
             array(
              'disabled' => false,
             ),
             'published_at' => 
             array(
              'disabled' => false,
             ),
             ));
        $searchable0 = new Doctrine_Template_Searchable(array(
             'fields' => 
             array(
              0 => 'code',
              1 => 'tagstr',
              2 => 'authorstr',
              3 => 'title',
              4 => 'description',
             ),
             ));
        $taggable0 = new Doctrine_Template_Taggable();
        $this->actAs($softdelete0);
        $this->actAs($balauditable0);
        $this->actAs($searchable0);
        $this->actAs($taggable0);
    }
}