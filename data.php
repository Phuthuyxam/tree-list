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
        private $DEEP = 2;
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
                        $template = '<a href="#"><div class="ptx-tree__item"><div class="ptx-tree__listinfo"><div class="ptx-listinfo__item">Tên người dùng: '. $elm['name'] .'</div><div class="ptx-listinfo__item">sđt: '. $elm['phone'] .'</div><div class="ptx-listinfo__item">Chức danh: Giam đốc</div><div class="ptx-listinfo__item">Mã người dùng: MBL80-032</div></div><div class="ptx-tree__profile"><div class="ptx-tree__avatar"><img src="https://cdn2.iconfinder.com/data/icons/avatar-profile/476/profile_avatar_contact_account_user_default-512.png"></div><div class="ptx-profile__item ptx-profile__name"><b>'. $elm['name'] .'</b></div><div class="ptx-profile__item"><strong>Điểm: sadasdasd</strong></div><div class="ptx-profile__item"><strong>Công việc: 0/0</strong></div></div></div></a>';
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

