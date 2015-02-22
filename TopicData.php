<?php


class TopicData {
protected $connection;

	public function connect()
	{
		$this->connection = new PDO("mysql:host=localhost;dbname=vote", "root", "root");
	}

	public function getAllTopics()
	{
		$query = $this->connection->prepare("SELECT * FROM topics");
		$query->execute();

		return $query;
	}


	public function add($data)
	{
		$query = $this->connection->prepare(
			"INSERT INTO topics (
				title,
				descr
			) VALUES (
				:title,
				:descr
			)"
		);

		$data = [
			':title' => $data['title'],
			':descr' => $data['descr']
		];

		$query->execute($data);
	}

	public function __construct()
	{
		$this->connect();
	}
	
	public function getTopic($id)
	{
		$sql = "SELECT * FROM topics WHERE id = :id LIMIT 1";
		$query = $this->connection->prepare($sql);

		$values = [':id' => $id];
		$query->execute($values);

		return $query->fetch(PDO::FETCH_ASSOC);
	}


	public function update($data)
	{
		$query = $this->connection->prepare(
			"UPDATE topics
				SET
					title = :title,
					descr = :descr
				WHERE
					id = :id"
				);
		$data = [
			':id' => $data['id'],
			':title' => $data['title'],
			':descr' => $data['descr']
		];

		return $query->execute($data);
	}
}



?>
