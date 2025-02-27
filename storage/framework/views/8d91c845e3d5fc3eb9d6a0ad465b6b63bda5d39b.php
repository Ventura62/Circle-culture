
<div class="aside aside-left d-flex aside-fixed" id="kt_aside">
    <!--begin::Primary-->

    <!--end::Primary-->
    <!--begin::Secondary-->
    <div class="aside-secondary d-flex flex-row-fluid">
        <!--begin::Workspace-->
        <div class="aside-workspace scroll scroll-push my-2">
            <!--begin::Tab Content-->
            <div class="tab-content">
                <!--begin::Tab Pane-->
                <!--end::Tab Pane-->
                <a href="<?php echo e(URL::to('/')); ?>">
                    
                </a>
                <!--begin::Tab Pane-->
                <div class="tab-pane fade show active" id="kt_aside_tab_2">
                    <!--begin::Aside Menu-->
                    <div class="aside-menu-wrapper flex-column-fluid px-10 py-5" id="kt_aside_menu_wrapper">
                        <!--begin::Menu Container-->
                        <div id="kt_aside_menu" class="aside-menu min-h-lg-800px" data-menu-vertical="1" data-menu-scroll="1">
                            <!--begin::Menu Nav-->
                            <ul class="menu-nav">

                                <li class="menu-item" aria-haspopup="true">
                                    <a  href="<?php echo e(route('dashboard')); ?>" class="text-muted  text-hover-primary font-weight-bold side-link">
                                        <div <?php if(request()->segment(1)==''): ?> style="background: #fff; border-radius: 10px" <?php endif; ?>  class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 <?php if(request()->segment(1)==''): ?> active <?php endif; ?> ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label ">
                                                        <span class="svg-icon svg-icon-xl  <?php if(request()->segment(1)=='' ): ?> svg-icon-success <?php endif; ?>">
                                                            <i style="font-size: 1.7rem" class=" <?php if(request()->segment(1)=='' ): ?> text-primary  <?php endif; ?> flaticon-squares"></i>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                    <span class="<?php if(request()->segment(1)=='' ): ?> text-primary <?php endif; ?> font-size-h6 mb-0">
                                                    Dashboard
                                                    </span>

                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>

                                </li>

                                <?php if(auth()->user()->type == 'admin'): ?>

                                    <li class="menu-item" aria-haspopup="true">
                                        <a <?php if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='templates'): ?> style="background: #fff; border-radius: 10px" <?php endif; ?> href="<?php echo e(route('templates')); ?>" class="text-muted text-hover-primary font-weight-bold side-link">
                                            <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 <?php if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='templates'): ?> active <?php endif; ?> ">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label  ">
                                                        <span class="svg-icon svg-icon-2xl">
                                                          <i style="font-size: 1.7rem"  class=" <?php if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='templates'): ?> text-primary  <?php endif; ?> icon-xl flaticon2-list-1"></i>                                             <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                    <span class="<?php if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='templates'): ?> text-primary <?php endif; ?> font-size-h6 mb-0">
                                                    Templates
                                                    </span>
                                                    </div>
                                                    <!--begin::End-->
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                        </a>
                                    </li>

                                    <li class="menu-item" aria-haspopup="true">
                                        <a <?php if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='settings'): ?> style="background: #fff; border-radius: 10px" <?php endif; ?> href="<?php echo e(route('settings')); ?>" class="text-muted text-hover-primary font-weight-bold side-link">
                                            <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 <?php if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='settings'): ?> active <?php endif; ?> ">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label  ">
                                                        <span class="svg-icon svg-icon-2xl">
                                                          <i style="font-size: 1.7rem"  class=" <?php if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='settings'): ?> text-primary  <?php endif; ?> icon-xl flaticon2-list-1"></i>                                             <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                    <span class="<?php if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='settings'): ?> text-primary <?php endif; ?> font-size-h6 mb-0">
                                                    Settings
                                                    </span>
                                                    </div>
                                                    <!--begin::End-->
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                        </a>
                                    </li>

                                <?php else: ?>

                                    <li class="menu-item" aria-haspopup="true">
                                        <a <?php if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='submissions'): ?> style="background: #fff; border-radius: 10px" <?php endif; ?> href="<?php echo e(route('submissions')); ?>" class="text-muted text-hover-primary font-weight-bold side-link">
                                            <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 <?php if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='submissions'): ?> active <?php endif; ?> ">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label  ">
                                                        <span class="svg-icon svg-icon-2xl">
                                                          <i style="font-size: 1.7rem"  class=" <?php if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='submissions'): ?> text-primary  <?php endif; ?> icon-xl flaticon2-list-1"></i>                                             <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                    <span class="<?php if(request()->segment(1)=='dashboard' &&  request()->segment(2)=='submissions'): ?> text-primary <?php endif; ?> font-size-h6 mb-0">
                                                    Submissions
                                                    </span>
                                                    </div>
                                                    <!--begin::End-->
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                        </a>
                                    </li>


                                <?php endif; ?>


                                
                                    
                                        
                                            
                                                
                                                
                                                    
                                                        
                                                          
                                                        
                                                    
                                                
                                                
                                                
                                                
                                                    
                                                    
                                                    
                                                
                                                
                                            
                                        
                                        
                                    
                                

                            </ul>
                            <!--end::Menu Nav-->
                        </div>
                        <!--end::Menu Container-->
                    </div>
                    <!--end::Aside Menu-->
                </div>

                <!--end::Tab Pane-->

            </div>
            <!--end::Tab Content-->
        </div>
        <!--end::Workspace-->

        <div class="aside-footer d-flex flex-column align-items-center flex-column-auto py-4 py-lg-10">
            <!--begin::Aside Toggle-->
            <span class="aside-toggle btn btn-icon btn-primary btn-hover-primary shadow-sm" id="kt_aside_toggle" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Toggle Aside">
                <i class="ki ki-bold-arrow-back icon-sm"></i>
            </span>
        </div>

    </div>
    <!--end::Secondary-->
</div>

<?php /**PATH D:\Laravel pros\picAi\resources\views/layouts/aside.blade.php ENDPATH**/ ?>