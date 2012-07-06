<?php


/**
 * This class defines the structure of the 'channel_track' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Jul  6 14:53:10 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ChannelTrackTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ChannelTrackTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('channel_track');
		$this->setPhpName('ChannelTrack');
		$this->setClassname('ChannelTrack');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('TRACK_ID', 'TrackId', 'INTEGER' , 'track', 'ID', true, 11, null);
		$this->addForeignKey('CHANNEL_ID', 'ChannelId', 'INTEGER', 'channel', 'ID', true, 11, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Track', 'Track', RelationMap::MANY_TO_ONE, array('track_id' => 'id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('Channel', 'Channel', RelationMap::MANY_TO_ONE, array('channel_id' => 'id', ), 'RESTRICT', 'RESTRICT');
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // ChannelTrackTableMap
