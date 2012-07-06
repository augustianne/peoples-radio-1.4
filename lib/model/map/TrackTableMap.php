<?php


/**
 * This class defines the structure of the 'track' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Jul  5 00:17:41 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class TrackTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.TrackTableMap';

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
		$this->setName('track');
		$this->setPhpName('Track');
		$this->setClassname('Track');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11, null);
		$this->addColumn('FILENAME', 'Filename', 'VARCHAR', true, 255, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 255, null);
		$this->addColumn('ARTIST', 'Artist', 'VARCHAR', false, 255, null);
		$this->addColumn('TIME', 'Time', 'VARCHAR', false, 10, null);
		$this->addColumn('GENRE', 'Genre', 'VARCHAR', false, 45, null);
		$this->addColumn('COVER', 'Cover', 'VARCHAR', false, 300, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Community', 'Community', RelationMap::ONE_TO_MANY, array('id' => 'track_id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('ChannelTrack', 'ChannelTrack', RelationMap::ONE_TO_ONE, array('id' => 'track_id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('TrackVote', 'TrackVote', RelationMap::ONE_TO_MANY, array('id' => 'track_id', ), 'RESTRICT', 'RESTRICT');
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

} // TrackTableMap
