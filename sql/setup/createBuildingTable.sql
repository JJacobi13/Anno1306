DROP TABLE IF EXISTS Buildings;

CREATE TABLE Buildings(
  name  VARCHAR(20),
  appClass  VARCHAR(20) UNIQUE ,
  woodCost  INT(3) DEFAULT 0,
  toolCost  INT(3) DEFAULT 0,
  buildingCost  INT(11) DEFAULT 0,
  upkeep INT(11) DEFAULT 0,
  product VARCHAR(20),
  productQuantity INT(3) DEFAULT 0,
  productCondition  VARCHAR(20),
  productConditionQuantity  INT(3) DEFAULT 0,
  productConditionRequired BOOLEAN DEFAULT false,
  object VARCHAR (20),
  inhabitants INT(3)DEFAULT 0,
  canBuild BOOLEAN DEFAULT true,
  PRIMARY KEY (appClass)
);

/*Insert the buildings*/
INSERT INTO buildings
  (name, appClass, toolCost, buildingCost, upkeep, product, productQuantity)
  VALUES
  ("Woodcutter", "woodcutter", 2, 100, 5, "wood", 1);

INSERT INTO buildings
  (name, appClass, woodCost, toolCost, buildingCost, upkeep, product, productQuantity)
  VALUES
  ("Fisherman's house", "fishermansHouse", 2, 2, 100, 5, "food", 5);

INSERT INTO buildings
  (name, appClass, woodCost, toolCost, buildingCost, upkeep, object, canBuild )
  VALUES
  ("Warehouse", "warehouse", 5, 5, 500, 20, "Warehouse", false);

INSERT INTO buildings
  (name, appClass, woodCost, upkeep, productCondition, productConditionQuantity, productConditionRequired)
  VALUES
  ("House", "house", 2, -10, "food", 1, true );