<?php
    class PTX_MAKE_DATA{
        private $data = [
                ["id"=> 1,"name"=>"ptx1","phone"=>"01212312","email"=>"ptx@gmail.com","parent"=>0],
                ["id"=>2,"name"=>"ptx2","phone"=>"01212312","email"=>"ptx2@gmail.com","parent"=>0],
                ["id"=>3,"name"=>"ptx3","phone"=>"01212312","email"=>"ptx@gmail.com","parent"=>0],
                ["id"=>4,"name"=>"ptx4","phone"=>"01212312","email"=>"ptx2@gmail.com","parent"=>0],
                ["id"=>5,"name"=>"ptx5","phone"=>"01212312","email"=>"ptx5@gmail.com","parent"=>1],
                ["id"=>6,"name"=>"ptx6","phone"=>"01212312","email"=>"ptx6@gmail.com","parent"=>1],
                ["id"=>7,"name"=>"ptx7","phone"=>"01212312","email"=>"ptx7@gmail.com","parent"=>5],
                ["id"=>8,"name"=>"ptx8","phone"=>"01212312","email"=>"ptx8@gmail.com","parent"=>7],
                ["id"=>9,"name"=>"ptx9","phone"=>"01212312","email"=>"ptx9@gmail.com","parent"=>3],
                ["id"=>10,"name"=>"ptx10","phone"=>"01212312","email"=>"ptx10@gmail.com","parent"=>9],
                ["id"=>11,"name"=>"ptx11","phone"=>"01212312","email"=>"ptx11@gmail.com","parent"=>10],
                ["id"=>12,"name"=>"ptx12","phone"=>"01212312","email"=>"ptx12@gmail.com","parent"=>2],
                ["id"=>13,"name"=>"ptx13","phone"=>"01212312","email"=>"ptx13@gmail.com","parent"=>12],
                ["id"=>14,"name"=>"ptx14","phone"=>"01212312","email"=>"ptx14@gmail.com","parent"=>6],
                ["id"=>15,"name"=>"ptx15","phone"=>"01212312","email"=>"ptx15@gmail.com","parent"=>11],
                ["id"=>16,"name"=>"ptx16","phone"=>"01212312","email"=>"ptx16@gmail.com","parent"=>11],
                ["id"=>17,"name"=>"ptx17","phone"=>"01212312","email"=>"ptx17@gmail.com","parent"=>16],
                ["id"=>18,"name"=>"ptx18","phone"=>"01212312","email"=>"ptx18@gmail.com","parent"=>17],
                ["id"=>19,"name"=>"ptx19","phone"=>"01212312","email"=>"ptx19@gmail.com","parent"=>8],
                ["id"=>20,"name"=>"ptx20","phone"=>"01212312","email"=>"ptx20@gmail.com","parent"=>18]
                ];
        private $treeDom = "";
        private $DEEP = 3;
        private $treeArray = [];
        protected function treeMakeElement($datas, $deep, $parent, $searchMode = false){
            $cateChild = array();
            $treeDom = $this->treeDom;
            $deep--;
            if($deep >= 0){
                foreach($datas as $element) {
                    if($element['parent'] == $parent){
                        $cateChild[] = $element;
                    }
                }
                if(!empty($cateChild)){
                    $this->treeDom = $this->treeDom . "<ul>";
                    foreach ($cateChild as $elm){
                        $template = '<a href="#"><div class="ptx-tree__item"><div class="ptx-tree__listinfo"><div class="ptx-listinfo__item">Tên người dùng: '. $elm['name'] .'</div><div class="ptx-listinfo__item">sđt: '. $elm['phone'] .'</div><div class="ptx-listinfo__item">Chức danh: Giam đốc</div><div class="ptx-listinfo__item">Mã người dùng: MBL80-032</div></div><div class="ptx-tree__profile"><div class="ptx-tree__avatar"><img src="data:image/jpeg;base64,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"></div><div class="ptx-profile__item ptx-profile__name"><b>'. $elm['name'] .'</b></div><div class="ptx-profile__item"><strong>Điểm: sadasdasd</strong></div><div class="ptx-profile__item"><strong>Công việc: 0/0</strong></div></div></div></a>';
                        $class_ = ($deep == 0) ? 'class="ptx_last_child" data-search="'. $searchMode .'"' : "";
                        $this->treeDom = $this->treeDom . '<li id="treeSub-'. $elm['id'] .'" '. $class_ .' data-id="'. $elm['id'] .'">' . $template;
                        $this->treeMakeElement($datas , $deep , $elm['id'] , $searchMode);
                        $this->treeDom = $this->treeDom . "</li>";
                    }
                    $this->treeDom = $this->treeDom."</ul>";
                }
            }
        }
        public function buildTree($parent){
            $this->treeMakeElement($this->data , $this->DEEP , $parent);
            return $this->treeDom;
        }

        public function buildTreeRoot($id, $dataCurrent){
            $this->treeBuildChild($this->data,$id);
            $node = 0;
            $count = 0;
            foreach ($this->treeArray as $item){
                $count++;
                if(in_array($item, $dataCurrent)){
                    $node = $item;
                    break;
                }
            }
            $this->treeMakeElement($this->data , $count , $node, true);
            return json_encode(['id' => $this->treeArray[$count - 1] , 'data' => $this->treeDom]);
        }

        public function treeBuildChild($datas, $id){
            foreach ($datas as $key => $element){
                if($element['id'] == $id){
                    array_push($this->treeArray, $element['parent']);
                    $this->treeBuildChild($datas , $element['parent']);
                    unset($datas[$key]);
                }
            }
        }

        public function searchTree($key){
            if($key == null) return "";
            return json_encode([["id"=>20,"name"=>"ptx20","phone"=>"01212312","email"=>"ptx20@gmail.com","parent"=>18],
                ["id"=>11,"name"=>"ptx11","phone"=>"01212312","email"=>"ptx11@gmail.com","parent"=>10],
                ["id"=>12,"name"=>"ptx12","phone"=>"01212312","email"=>"ptx12@gmail.com","parent"=>2],
                ["id"=>13,"name"=>"ptx13","phone"=>"01212312","email"=>"ptx13@gmail.com","parent"=>12],]);
        }
    }
    $GLOBALS['PTX_MAKE_DATA'] = new PTX_MAKE_DATA();

