
                      <?php
                        require_once('../class/crud.php');
                        require_once('../class/config.php');
                        $crud = new crud();
                        ?>
                    <?php if ($_GET) {
                        $A['purchase_id'] = $_GET['id'];
                        $rs = $crud->common_select('purchases_details', '*', $A);
                        if ($rs['success'] == 1) {
                            foreach ($rs['msg'] as $as) {
                                $AS['id'] = $as->product_id;
                                $qty = $as->qty;
                                $rss = $crud->common_select('products', '*', $AS);
                                $after['stock'] = $rss['msg'][0]->stock - $qty;
                                $ins = $crud->common_update('products', $after, $AS);
                                if ($ins['success']) {
                                    $rsss = $crud->common_delete('purchases', $_GET);
                                    if ($rsss['success']) {
                                        $rssss = $crud->common_delete('purchases_details', $A);
                                        if ($rssss['success']) {
                                            echo "<script>window.location.href = '{$base_url}purchase/index.php';</script>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                    ?>