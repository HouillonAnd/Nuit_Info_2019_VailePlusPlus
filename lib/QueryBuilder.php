<?php

// Création d'un queryBuilder, afin de rendre la création de requête plus simple.

/**
 * 
 *  Structure :
 * 
 *  select                DONE
 *  select count         DONE
 *  from                 DONE
 *  join                DONE
 *  left outer join       DONE
 *  right outer join      DONE
 *  where                DONE
 *  and                 DONE
 *  order By              DONE
 *  limit                DONE
 *  offset                 DONE
 *  page
 *  setParam
 *  distinct
 *  having
 *  insertInto
 *  values
 *  update
 *  set
 *  delete
 * 
 * 
*/



    class QueryBuilder {

        public $sql;

        public function select ($attribut, $alias = NULL): self {
            $this->sql = "SELECT ";
            if (is_array($attribut)) {
                for ($i = 0; $i < sizeof($attribut); $i++) {
                    $this->sql .= $alias[$i].'.'.$attribut[$i].", ";
                }
                $this->sql = rtrim($this->sql, ", ");
            } else if ($attribut == "*") {
                if (!is_null($alias)) {
                    $this->sql .= $alias.'.'.$attribut." ";
                } else {
                    $this->sql .= $attribut." ";
                }
            } else {
                if (!is_null($alias)) {
                    $this->sql .= $alias.'.'.$attribut." ";
                } else {
                    $this->sql .= $attribut." ";
                }
            }
            return $this;
        }

        public function count ($key, $alias = NULL): self {
            if (isset($alias)) {
                $this->sql = "SELECT COUNT($key) as $alias";
            } else {
                $this->sql = "SELECT COUNT($key)";
            }
            return $this;
        }

        public function from (string $table, string $alias = NULL): self {
            if (is_null($alias)) {
                $this->sql .= " FROM $table";
            } else {
                $this->sql .= " FROM $table $alias";
            }
            return $this;
        }

        public function join(string $table1, string $alias1 = NULL, string $alias2 = NULL, string $attribut2, string $attribut1): self {
            $this->sql .= " JOIN $table1 $alias1 ON $alias2.$attribut2 = $alias1.$attribut1 ";
            return $this;
        }

        public function leftOuterJoin(string $table1, string $alias1 = NULL, string $alias2 = NULL, string $attribut1, string $attribut2): self {
            $this->sql .= " LEFT OUTER JOIN $table1 $alias1 ON $alias2.$attribut2 = $alias1.$attribut1 ";
            return $this;
        }

        public function rightOuterJoin(string $table1, string $alias1 = NULL, string $alias2 = NULL, string $attribut1, string $attribut2): self {
            $this->sql .= " RIGHT OUTER JOIN $table1 $alias1 ON $alias2.$attribut2 = $alias1.$attribut1 ";
            return $this;
        }

            // ici il faut utiliser pdo pour preparer la requête et l'inserer
        public function where (string $condition, string $symbole, $value): self {
            $this->sql .= " WHERE $condition $symbole '$value'";
            return $this;
        }

        public function and (string $condition, $value): self {
            $this->sql .= " AND $condition = '$value'";
            return $this;
        }

        public function orderBy (string $key, string $direction): self {
            $direction = strtoupper($direction);
            if (!in_array($direction, ['ASC', 'DESC'])) {
                $this->sql .= " ORDER BY $key";
            } else {
                $this->sql .= " ORDER BY $key $direction";
            }
            return $this;
        }

        public function limit (int $limit): self {
            $this->sql .= " LIMIT $limit";
            return $this;
        }

        public function offset (int $offset): self {
            $this->sql .= " OFFSET $offset";
            return $this;
        }


/*
        public function page (int $limit, int $page): self {
            return $this->offset($limit * ($page -1));
            return $this;
        }
*/

/*
        public function setParam(string $key, $value): self {
            $this->params[$key] = $value;
            return $this;
        }
*/

        public function distinct () {
            return $this;
        }

        public function having () {
            return $this;
        }

        public function insertInto ($table) {
            return $this;
        }

        public function values () {
            return $this;
        }

        public function update () {
            return $this;
        }

        public function set () {
            
        }

        public function delete () {
            return $this;
        }



    public function fetch (PDO $pdo, string $field): ?string {

            $query = $pdo->prepare($this->getSQL());

            $query->execute($this->params);

            $result = $query->fetch();

            if ($result === false) {
                return null;
            }

            return $result[$field] ?? null;

        }

        public function getSQL () {
            return (string)$this->sql;
        }



    public function test () {

        //------------------------------------------------------------------------------------------------
        
                $myRequest = new QueryBuilder;
        
                $myRequest->count('*', 'nb_number_count')
                          ->from('table1', 'I')
                          ->rightOuterJoin('table2', 'Alias2', 'alias1', 'attribut1', 'attribut2')
                          ->where('prix', '=', 10)
                          ->orderBy('prix', 'DESC')
                          ->limit(10)
                          ->offset(20);
        
                $test = $myRequest->getSQL();
        
                echo $test;
        
        //------------------------------------------------------------------------------------------------
        
                echo "<br>";
        
        // select * from commande join lignecommande on id_commande = id_commande

                $myRequest2 = new QueryBuilder;
        
                $myRequest2->select('*')
                          ->from('produit', 'P')
                          ->join('categorisation', 'C', 'P', 'id_produit', 'id')
                          ->join('categorie', 'CA', 'C', 'id', 'id_categorie')
                          ->where('prix', '=', 10)
                          ->orderBy('prix', 'DESC')
                          ->limit(10)
                          ->offset(20);
            
                echo $myRequest2->getSQL();
            
        //------------------------------------------------------------------------------------------------
        
                echo "<br>";
            
                $myRequest3 = new QueryBuilder;
        
                $myRequest3->count('id')
                           ->from('produit', 'P');
            
                echo $myRequest3->getSQL();
            
        //------------------------------------------------------------------------------------------------
        
                echo "<br>";
            
                $myRequest4 = new QueryBuilder;
        
                $myRequest4->select(array('id', 'description', 'id'), array('P', 'P', 'P'));
            
                echo $myRequest4->getSQL();
            
        //------------------------------------------------------------------------------------------------
                
                echo "<br>";
        
                //$query = QueryBuilder::from('produit', 'p');
                //->orderBy('prix', 'DESC')->limit(10)::getSQL();
                //var_dump($query);
                //echo $query;
                //echo '1';
                //echo $myRequest;
        
            }

}

?>