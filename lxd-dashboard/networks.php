<!--
LXDWARE LXD Dashboard - A web-based interface for managing LXD servers
Copyright (C) 2020-2021  LXDWARE.COM

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" type="image/png" href="assets/images/logo-light.svg">

  <title>LXD Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/fonts/nunito.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="vendor/sb-admin-2/css/sb-admin-2.css" rel="stylesheet">
  <link href="assets/css/style.css?version=3.0" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion sidebar-divider-right" id="accordionSidebar">
      
      <div id="sidebarLinks"></div>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block"> 

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" onclick="setSidebarToggleValue()"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Notification -->
          <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <ul class="navbar-nav ml-auto"> 

              <li class="nav-item dropdown no-arrow" id="notificationArea" style="display: none;">
                <div class="nav-link dropdown-toggle">
                  <span id="notification" class="mr-2 d-none d-lg-inline text-danger">Notification</span>
                </div>
              </li>
              
            </ul>
          </div>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto"> 

            <li class="nav-item dropdown">
              <label class="h6 mt-4 mr-2 ml-4">Host: </label>
            </li>
            <li class="nav-item dropdown">
              <div class="input-group mt-3">
                <select class="form-control" id="remoteListNav" style="width:150px;" onchange="location = this.value;">
                </select>
              </div>
            </li>

            <li class="nav-item dropdown">
              <label class="h6 mt-4 mr-2 ml-4">Project: </label>
            </li>
            <li class="nav-item dropdown">
              <div class="input-group mt-3">
                <select class="form-control" id="projectListNav" style="width:150px;" onchange="location = this.value;">
                </select>
              </div>
            </li>

            <!-- Nav Divider -->
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-1x fa-fw mr-2 text-gray-600"></i>
                <span id="username" class="mr-2 d-none d-lg-inline text-gray-600"></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="user-profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="settings.php">
                  <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#aboutModal">
                  <i class="fas fa-info-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                  About
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" onclick="logout()">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
            <div class="container-xl px-4">
              <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between mt-n5 ml-n5 mr-n5 bg-dark pb-6">
                  <div class="col-auto mt-4 ml-3">
                    <div class="page-header-subtitle">
                      <a href="#" id="remoteBreadCrumb"></a>
                    </div>
                    <h2 class="page-header-title mt-2">
                      NETWORKS
                    </h2>
                    <div class="page-header-subtitle">
                      Create and manage LXD networks
                    </div>
                  </div>
                  <div class="col-12 col-xl-auto mt-4">
                    <div class="input-group input-group-joined border-0" style="width: 14rem">
                      <span class="input-group-text bg-transparent border-0">
                        <a class="btn btn-outline-primary" href="#" onclick="loadCreateNetworkModal()" title="New Network" aria-hidden="true">
                          <i class="fas fa-plus fa-sm fa-fw"></i> Network
                        </a>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </header>

          <div class="row mt-n5 ml-2 mr-2">

            <div class="col-12 mt-n3">
              <!-- Network List -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold">
                    <span class="ml-1">Networks</span>
                  </h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle mr-2" href="#" onclick="reloadPageContent()" title="Refresh" aria-hidden="true">
                      <i class="fa fa-sync fa-1x fa-fw"></i></a>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="networkListTable" width="100%" cellspacing="0">
                    </table>
                  </div>
                </div>
              </div>
              <!-- End Network List -->
            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; LXDWARE 2020 - Present</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Create Network Modal-->
  <div class="modal fade" id="createNetworkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Network</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="form-tab" data-toggle="tab" href="#form" role="tab" aria-controls="form" aria-selected="true">Form</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="json-tab" data-toggle="tab" href="#json" role="tab" aria-controls="json" aria-selected="false">JSON</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="form" role="tabpanel" aria-labelledby="form-tab">
                <div class="modal-body">
                  <div class="row">
                    <label class="col-3 col-form-label text-right">Name: <span class="text-danger">*</span></label>
                    <div class="col-7">
                      <div class="form-group">
                        <input type="text" id="networkNameInput" class="form-control" placeholder="" name="networkNameInput">
                      </div>
                    </div>
                    <div class="col-1">
                      <i class="far fa-sm fa-question-circle" title='(Required) - Enter the name of this network.'></i>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-3 col-form-label text-right">Network Type: <span class="text-danger">*</span></label>
                    <div class="col-7">
                      <div class="form-group">
                        <select id="networkTypeInput" onchange="changeNetworkTypeInput()" class="form-control" name="networkTypeInput">
                          <option value="bridge">bridge</option>
                          <option value="macvlan">macvlan</option>
                          <option value="ovn">ovn</option>
                          <option value="physical">physical</option>
                          <option value="sriov">sriov</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-1">
                      <i class="far fa-sm fa-question-circle" title='(Required) - Select the type of network. Default: bridge'></i>
                    </div>
                  </div>
                  <div class="row" id="networkParentRow" style="display: none;">
                    <label class="col-3 col-form-label text-right">Parent: <span class="text-danger">*</span></label>
                    <div class="col-7">
                      <div class="form-group">
                        <select id="networkParentInput" onchange="" class="form-control" name="networkParentInput">
                        </select>
                      </div>
                    </div>
                    <div class="col-1">
                      <i class="far fa-sm fa-question-circle" title='(Required) - Select the parent interface to create the network on'></i>
                    </div>
                  </div>
                  <div class="row" id="networkNetworkRow" style="display: none;">
                    <label class="col-3 col-form-label text-right">Network: <span class="text-danger">*</span></label>
                    <div class="col-7">
                      <div class="form-group">
                        <select id="networkNetworkInput" onchange="" class="form-control" name="networkNetworkInput">
                        </select>
                      </div>
                    </div>
                    <div class="col-1">
                      <i class="far fa-sm fa-question-circle" title='(Required) - Select the uplink network interface for external connections.'></i>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-3 col-form-label text-right">Description: </label>
                    <div class="col-7">
                      <div class="form-group">
                        <input type="text" id="networkDescriptionInput" class="form-control" placeholder="" name="networkDescriptionInput">
                      </div>
                    </div>
                    <div class="col-1">
                      <i class="far fa-sm fa-question-circle" title='Enter in a description to help describe this network.'></i>
                    </div>
                  </div>

                  <hr>

                  <div id="accordionConfigurationProperties">
                    <h2>
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#configurationProperties" aria-expanded="false" aria-controls="configurationProperties">
                        Configuration Properties
                      </button>
                    </h2> 
                    <div id="configurationProperties" class="collapse" aria-labelledby="configurationProperties">
                      <div class="row" id="networkMtuRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">MTU: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="number" id="networkMtuInput" class="form-control" placeholder="" name="networkMtuInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Enter in the MTU of interface. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkVlanRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">VLAN: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="number" id="networkVlanInput" class="form-control" placeholder="" name="networkVlanInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Enter in a VLAN ID. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkDnsNameserversRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">DNS Nameservers: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkDnsNameserversInput" class="form-control" placeholder="" name="networkDnsNameserversInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used in standard bridge mode. Enter in a comma seperated list of DNS nameservers on the physical network. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkBridgeDriverRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">Bridge Driver: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkBridgeDriverInput" onchange="" class="form-control" name="networkBridgeDriverInput">
                              <option value="">(not set)</option>
                              <option value="native">native</option>
                              <option value="openvswitch">openvswitch</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Select the bridge driver. Default: native'></i>
                        </div>
                      </div>
                      <div class="row" id="networkBridgeExternalInterfacesRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">Bridge External Interfaces: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkBridgeExternalInterfacesInput" class="form-control" placeholder="" name="networkBridgeExternalInterfacesInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Enter in a comma separated list of unconfigured network interfaces to be included in this bridge. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkBridgeHwaddrRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">Bridge HWADDR: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkBridgeHwaddrInput" class="form-control" placeholder="" name="networkBridgeHwaddrInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Enter in a MAC address for this bridge. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkBridgeModeRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">Bridge Mode: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkBridgeModeInput" onchange="" class="form-control" name="networkBridgeModeInput">
                              <option value="">(not set)</option>
                              <option value="fan">fan</option>
                              <option value="standard">standard</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Select the bridge operation mode. Default: standard'></i>
                        </div>
                      </div>
                      <div class="row" id="networkBridgeMtuRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">Bridge MTU: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="number" id="networkBridgeMtuInput" class="form-control" placeholder="" name="networkBridgeMtuInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Enter in the MTU. Default value may very when using fan mode or a tunnel. Default: 1500'></i>
                        </div>
                      </div>
                      <div class="row" id="networkDnsDomainRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">DNS Domain: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkDnsDomainInput" class="form-control" placeholder="" name="networkDnsDomainInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Enter in a domain that will be advertise to DHCP clients for DNS resolution. Default: lxd'></i>
                        </div>
                      </div>
                      <div class="row" id="networkDnsModeRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">DNS Mode: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkDnsModeInput" onchange="" class="form-control" name="networkDnsModeInput">
                              <option value="">(not set)</option>
                              <option value="dynamic">dynamic</option>
                              <option value="managed">managed</option>
                              <option value="none">none</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Select a DNS registration mode. Use "none" for no DNS record. Use "managed" for static records generated by LXD. Use "dynamic" for records generated by the client. Default: managed'></i>
                        </div>
                      </div>
                      <div class="row" id="networkDnsSearchRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">DNS Search: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkDnsSearchInput" class="form-control" placeholder="" name="networkDnsSearchInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Enter in a comma separated domain search list. Default: lxd'></i>
                        </div>
                      </div>
                      <div class="row" id="networkFanOverlaySubnetRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">Fan Overlay Subnet: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkFanOverlaySubnetInput" class="form-control" placeholder="" name="networkFanOverlaySubnetInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if using "fan" bridge mode. Enter in a CIDR notation subnet used as the overlay for the FAN. Default: 240.0.0.0/8'></i>
                        </div>
                      </div>
                      <div class="row" id="networkFanTypeRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">Fan Type: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkFanTypeInput" onchange="" class="form-control" name="networkFanTypeInput">
                              <option value="">(not set)</option>
                              <option value="ipip">ipip</option>
                              <option value="vxlan">vxlan</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if using "fan" bridge mode. Select the tunneling type for the FAN. Default: vxlan'></i>
                        </div>
                      </div>
                      <div class="row" id="networkFanUnderlaySubnetRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">Fan Underlay Subnet: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkFanUnderlaySubnetInput" class="form-control" placeholder="" name="networkFanUnderlaySubnetInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if using "fan" bridge mode. Enter in a CIDR notation subnet used as the underlay for the FAN. Use "auto" to use the subnet of the default gateway. Default: auto'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4AddressRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 Address: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv4AddressInput" class="form-control" placeholder="" name="networkIpv4AddressInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if using "standard" bridge mode. Enter in a CIDR notation IPv4 address for the bridge. To turn off IPv4 enter "none". To generate a new random unused subnet enter "auto". Default: auto'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4DhcpRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 DHCP: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv4DhcpInput" onchange="" class="form-control" name="networkIpv4DhcpInput">
                              <option value="">(not set)</option>
                              <option value="true">true</option>
                              <option value="false">false</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv4 Address is created. Select whether to allocate addresses using DHCP. Default: true'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4DhcpExpiryRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 DHCP Expiry: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv4DhcpExpiryInput" class="form-control" placeholder="" name="networkIpv4DhcpExpiryInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv4 DHCP is true. Enter in the length of time for DHCP leases to expire. Default: 1h'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4DhcpGatewayRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 DHCP Gateway: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv4DhcpGatewayInput" class="form-control" placeholder="" name="networkIpv4DhcpGatewayInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv4 DHCP is true. Enter in a gateway address, if different from entered IPv4 address. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4DhcpRangesRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 DHCP Ranges: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv4DhcpRangesInput" class="form-control" placeholder="" name="networkIpv4DhcpRangesInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv4 DHCP is true. Enter in a comma separated list of IP ranges to use for DHCP. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4FirewallRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 Firewall: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv4FirewallInput" onchange="" class="form-control" name="networkIpv4FirewallInput">
                              <option value="">(not set)</option>
                              <option value="true">true</option>
                              <option value="false">false</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv4 Address is created. Select whether to generate filtering firewall rules. Default: true'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4NatAddressRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 NAT Address: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv4NatAddressInput" class="form-control" placeholder="" name="networkIpv4NatAddressInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv4 Address is created. Enter in the source IP address used for outbound traffic from the bridge. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4NatRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 NAT: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv4NatInput" onchange="" class="form-control" name="networkIpv4NatInput">
                              <option value="">(not set)</option>
                              <option value="true">true</option>
                              <option value="false">false</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv4 Address is created. Select whether or not to use NAT. Default: true (for bridges), false (for non-bridges)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4NatOrderRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 NAT Order: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv4NatOrderInput" onchange="" class="form-control" name="networkIpv4NatOrderInput">
                              <option value="">(not set)</option>
                              <option value="after">after</option>
                              <option value="before">before</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv4 Address is created. Select whether to add the NAT rules before or after any pre-existing rules. Default: before'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4OvnRangesRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 OVN Ranges: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv4OvnRangesInput" class="form-control" placeholder="" name="networkIpv4OvnRangesInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Enter in a comma separated list of IPv4 ranges. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4GatewayRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 Gateway: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv4GatewayInput" class="form-control" placeholder="" name="networkIpv4GatewayInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used in standard bridge mode. Using CIDR notation, enter in the IPv4 address for the gateway. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4RoutesAnycastRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 Routes Anycast: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv4RoutesAnycastInput" onchange="" class="form-control" name="networkIpv4RoutesAnycastInput">
                              <option value="">(not set)</option>
                              <option value="true">true</option>
                              <option value="false">false</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv4 Address is created. Select whether or not to allow overlapping routes on multiple networks or NICs at the same time. Default: false'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4RoutesRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 Routes: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv4RoutesInput" class="form-control" placeholder="" name="networkIpv4RoutesInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv4 Address is created. Enter in a comma separated list of additional IPv4 subnets to route to the bridge. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv4RoutingRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv4 Routing: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv4RoutingInput" onchange="" class="form-control" name="networkIpv4RoutingInput">
                              <option value="">(not set)</option>
                              <option value="true">true</option>
                              <option value="false">false</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv4 Address is created. Select whether to route network traffic in and out of the bridge. Default: true'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6AddressRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 Address: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv6AddressInput" class="form-control" placeholder="" name="networkIpv6AddressInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if using "standard" bridge mode. Enter in a CIDR notation IPv6 address for the bridge. To turn off IPv6 enter "none". To generate a new random unused subnet enter "auto". Default: auto'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6DhcpRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 DHCP: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv6DhcpInput" onchange="" class="form-control" name="networkIpv6DhcpInput">
                              <option value="">(not set)</option>
                              <option value="true">true</option>
                              <option value="false">false</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv6 Address is created. Select whether to provide additional DHCP configurations over the network. Default: true'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6DhcpExpiryRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 DHCP Expiry: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv6DhcpExpiryInput" class="form-control" placeholder="" name="networkIpv6DhcpExpiryInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv6 DHCP is true. Enter in the length of time for DHCP leases to expire. Default: 1h'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6DhcpRangesRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 DHCP Ranges: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv6DhcpRangesInput" class="form-control" placeholder="" name="networkIpv6DhcpRangesInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv6 DHCP is true and stateful. Enter in a comma separated list of IPv6 ranges. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6DhcpStatefulRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 DHCP Stateful: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv6DhcpStatefulInput" onchange="" class="form-control" name="networkIpv6DhcpStatefulInput">
                              <option value="">(not set)</option>
                              <option value="true">true</option>
                              <option value="false">false</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv6 DHCP is true. Select whether to use DHCP to allocate addresses. Default: false'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6FirewallRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 Firewall: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv6FirewallInput" onchange="" class="form-control" name="networkIpv6FirewallInput">
                              <option value="">(not set)</option>
                              <option value="true">true</option>
                              <option value="false">false</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv6 Address is created. Select whether to generate filtering firewall rules. Default: true'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6NatAddressRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 NAT Address: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv6NatAddressInput" class="form-control" placeholder="" name="networkIpv6NatAddressInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv6 Address is created. Enter in the source IP address used for outbound traffic from the bridge. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6NatRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 NAT: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv6NatInput" onchange="" class="form-control" name="networkIpv6NatInput">
                              <option value="">(not set)</option>
                              <option value="true">true</option>
                              <option value="false">false</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv6 Address is created. Select whether or not to use NAT. Default: true'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6NatOrderRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 NAT Order: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv6NatOrderInput" onchange="" class="form-control" name="networkIpv6NatOrderInput">
                              <option value="">(not set)</option>
                              <option value="after">after</option>
                              <option value="before">before</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv6 Address is created. Select whether to add the NAT rules before or after any pre-existing rules. Default: before'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6OvnRangesRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 OVN Ranges: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv6OvnRangesInput" class="form-control" placeholder="" name="networkIpv6OvnRangesInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Enter in a comma separated list of IPv6 ranges. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6GatewayRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 Gateway: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv6GatewayInput" class="form-control" placeholder="" name="networkIpv6GatewayInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used in standard bridge mode. Using CIDR notation, enter in the IPv6 address for the gateway. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6RoutesAnycastRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 Routes Anycast: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv6RoutesAnycastInput" onchange="" class="form-control" name="networkIpv6RoutesAnycastInput">
                              <option value="">(not set)</option>
                              <option value="true">true</option>
                              <option value="false">false</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv6 Address is created. Select whether or not to allow overlapping routes on multiple networks or NICs at the same time. Default: false'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6RoutesRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 Routes: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkIpv6RoutesInput" class="form-control" placeholder="" name="networkIpv6RoutesInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv6 Address is created. Enter in a comma separated list of additional IPv6 subnets to route to the bridge. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkIpv6RoutingRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">IPv6 Routing: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkIpv6RoutingInput" onchange="" class="form-control" name="networkIpv6RoutingInput">
                              <option value="">(not set)</option>
                              <option value="true">true</option>
                              <option value="false">false</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv6 Address is created. Select whether to route network traffic in and out of the bridge. Default: true'></i>
                        </div>
                      </div>
                      <div class="row" id="networkMaasSubnetIpv4Row" style="display: none;">
                        <label class="col-3 col-form-label text-right">MAAS Subnet IPv4: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkMaasSubnetIpv4Input" class="form-control" placeholder="" name="networkMaasSubnetIpv4Input">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv4 Address is created. Enter the MAAS IPv4 subnet to register the instances in. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkMaasSubnetIpv6Row" style="display: none;">
                        <label class="col-3 col-form-label text-right">MAAS Subnet IPv6: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkMaasSubnetIpv6Input" class="form-control" placeholder="" name="networkMaasSubnetIpv6Input">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used only if IPv6 Address is created. Enter the MAAS IPv6 subnet to register the instances in. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkRawDnsmasqRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">Raw DNSmasq: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <input type="text" id="networkRawDnsmasqInput" class="form-control" placeholder="" name="networkRawDnsmasqInput">
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Enter in any additional dnsmasq configuration. Default: (not set)'></i>
                        </div>
                      </div>
                      <div class="row" id="networkOvnIngressModeRow" style="display: none;">
                        <label class="col-3 col-form-label text-right">OVN Ingress Mode: </label>
                        <div class="col-7">
                          <div class="form-group">
                            <select id="networkOvnIngressModeInput" onchange="" class="form-control" name="networkOvnIngressModeInput">
                              <option value="">(not set)</option>
                              <option value="l2proxy">l2proxy</option>
                              <option value="routed">routed</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-1">
                          <i class="far fa-sm fa-question-circle" title='Used in standard bridge mode. Select whether or not to allow overlapping routes on multiple networks or NICs at the same time. Default: false'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="#" onclick="createNetworkUsingForm()" data-dismiss="modal">Submit</a>
                </div>
              </div>
              <div class="tab-pane fade" id="json" role="tabpanel" aria-labelledby="json-tab">
                <br />
                <div class="row">
                  <div class="col-12">
                    <div class="form-group text-right">
                      <pre>
                        <textarea name="json" class="form-control" id="jsonCreateInput" rows="16" placeholder="Enter JSON data"></textarea>
                      </pre>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="#" onclick="createNetworkUsingJSON()" data-dismiss="modal">Submit</a>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

  <!-- Edit Network Modal-->
  <div class="modal fade" id="editNetworkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Network</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <label class="col-12 col-form-label" id="networkNameEditInput"></label>
              <div class="col-12">
                <div class="form-group text-right">
                  <pre>
                    <textarea name="json" class="form-control" id="jsonEditInput" rows="16" ></textarea>
                  </pre>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="#" onclick="updateNetwork()" data-dismiss="modal">Submit</a>
          </div>
      </div>
    </div>
  </div>

  <!-- Rename Network Modal-->
  <div class="modal fade" id="renameNetworkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="renameNetworkModalLabel">Rename Network</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <label class="col-3 col-form-label text-right" id="newNetworkNameLabel">Name: <span class="text-danger">*</span></label>
              <div class="col-7">
                <div class="form-group">
                  <input type="text" id="newNetworkName" class="form-control" placeholder="">
                </div>
              </div>
              <div class="col-1">
                <i class="far fa-sm fa-question-circle" title='(Required) - Enter in a new name for the network.'></i>
              </div>
            </div>
            <input type="hidden" id ="networkToRename" name="networkToRename">
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="#" onclick="renameNetwork()" data-dismiss="modal">Ok</a>
          </div>
      </div>
    </div>
  </div>

  <!-- About Modal-->
  <div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">About</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div id="about"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Dismiss</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="vendor/sb-admin-2/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>

<script>
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const remoteId = urlParams.get('remote'); 
  const projectName = urlParams.get('project'); 
  var networkToUpdate = "";

  function logout(){
    $.get("./backend/aaa/authentication.php?action=deauthenticateUser", function (data) {
      operationData = JSON.parse(data);
      console.log(operationData);
      if (operationData.status_code == 200) {
        window.location.href = './index.php'
      }
    });
  }

  function operationStatusCheck(){
    clearTimeout(operationTimeout);
    //check to see if there are any running operations
    $.get("./backend/lxd/operations.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName) + "&action=displayOperationStatus", function (data) {
      //Check to see if we have running operations
      if (data) {
        //Display notification area if there are running tasks
        $('#notificationArea').show();
        $('#notification').text("Notice: " + data);
        //Set the page to check operations again in 2 seconds
        operationTimeout = setTimeout(() => { operationStatusCheck(); }, 2000);
      }
      else {
        //Hide notification area if no running tasks
        $('#notificationArea').hide();
        $('#notification').text("");
        //Set the page to check operations again in 4 seconds
        operationTimeout = setTimeout(() => { operationStatusCheck(); }, 4000);
      }
    });
  }

  function reloadPageContent() {

    clearTimeout(pageReloadTimeout);

    //Check Authorization
    $.get("./backend/aaa/authentication.php?action=validateAuthentication", function (data) {
      operationData = JSON.parse(data);
      if (operationData.status_code != 200) {
        console.log(operationData);
        window.location.href = './index.php'
      }
    });

    $('#networkListTable').DataTable().ajax.reload(null, false);

    pageReloadTimeout = setTimeout(() => { reloadPageContent(); }, 7000);
  }

  function loadPageContent(){

    //Display current logged in username
    $("#username").load("./backend/admin/settings.php?action=displayUsername");

    $('#networkListTable').DataTable( {
      ajax: "./backend/lxd/networks.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName) + "&action=listNetworks",
      columns: [
        {},
        { title: "Name" },
        { title: "Description" },
        { title: "IPv4" },
        { title: "IPv6" },
        { title: "Type" },
        { title: "Managed" },
        { title: "Action" }
      ],
      order: [],
      columnDefs: [
        { targets: 0, orderable: false, width: "25px" }
      ]
    });

    //Check for any running operations
    operationTimeout = setTimeout(() => { operationStatusCheck(); }, 1000);

    //Reload page content in 7 seconds
    pageReloadTimeout = setTimeout(() => { reloadPageContent(); }, 7000);
  }

  function createNetworkUsingForm(){
    var networkNameInput = $("#networkNameInput").val();
    var networkTypeInput = $("#networkTypeInput").val();
    var networkDescriptionInput = $("#networkDescriptionInput").val();
    var networkBridgeDriverInput = $("#networkBridgeDriverInput").val();
    var networkBridgeExternalInterfacesInput = $("#networkBridgeExternalInterfacesInput").val();
    var networkBridgeHwaddrInput = $("#networkBridgeHwaddrInput").val();
    var networkBridgeModeInput = $("#networkBridgeModeInput").val();
    var networkBridgeMtuInput = $("#networkBridgeMtuInput").val();
    var networkDnsDomainInput = $("#networkDnsDomainInput").val();
    var networkDnsModeInput = $("#networkDnsModeInput").val();
    var networkDnsSearchInput = $("#networkDnsSearchInput").val();
    var networkFanOverlaySubnetInput = $("#networkFanOverlaySubnetInput").val();
    var networkFanTypeInput = $("#networkFanTypeInput").val();
    var networkFanUnderlaySubnetInput = $("#networkFanUnderlaySubnetInput").val();
    var networkIpv4AddressInput = $("#networkIpv4AddressInput").val();
    var networkIpv4DhcpInput = $("#networkIpv4DhcpInput").val();
    var networkIpv4DhcpExpiryInput = $("#networkIpv4DhcpExpiryInput").val();
    var networkIpv4DhcpGatewayInput = $("#networkIpv4DhcpGatewayInput").val();
    var networkIpv4DhcpRangesInput = $("#networkIpv4DhcpRangesInput").val();
    var networkIpv4FirewallInput = $("#networkIpv4FirewallInput").val();
    var networkIpv4NatAddressInput = $("#networkIpv4NatAddressInput").val();
    var networkIpv4NatInput = $("#networkIpv4NatInput").val();
    var networkIpv4NatOrderInput = $("#networkIpv4NatOrderInput").val();
    var networkIpv4OvnRangesInput = $("#networkIpv4OvnRangesInput").val();
    var networkIpv4RoutesInput = $("#networkIpv4RoutesInput").val();
    var networkIpv4RoutingInput = $("#networkIpv4RoutingInput").val();
    var networkIpv6AddressInput = $("#networkIpv6AddressInput").val();
    var networkIpv6DhcpInput = $("#networkIpv6DhcpInput").val();
    var networkIpv6DhcpExpiryInput = $("#networkIpv6DhcpExpiryInput").val();
    var networkIpv6DhcpRangesInput = $("#networkIpv6DhcpRangesInput").val();
    var networkIpv6DhcpStatefulInput = $("#networkIpv6DhcpStatefulInput").val();
    var networkIpv6FirewallInput = $("#networkIpv6FirewallInput").val();
    var networkIpv6NatAddressInput = $("#networkIpv6NatAddressInput").val();
    var networkIpv6NatInput = $("#networkIpv6NatInput").val();
    var networkIpv6NatOrderInput = $("#networkIpv6NatOrderInput").val();
    var networkIpv6OvnRangesInput = $("#networkIpv6OvnRangesInput").val();
    var networkIpv6RoutesInput = $("#networkIpv6RoutesInput").val();
    var networkIpv6RoutingInput = $("#networkIpv6RoutingInput").val();
    var networkMaasSubnetIpv4Input = $("#networkMaasSubnetIpv4Input").val();
    var networkMaasSubnetIpv6Input = $("#networkMaasSubnetIpv6Input").val();
    var networkRawDnsmasqInput = $("#networkRawDnsmasqInput").val();
    var networkMtuInput = $("#networkMtuInput").val();
    var networkParentInput = $("#networkParentInput").val();
    var networkVlanInput = $("#networkVlanInput").val();
    var networkNetworkInput = $("#networkNetworkInput").val();
    var networkIpv4GatewayInput = $("#networkIpv4GatewayInput").val();
    var networkIpv4RoutesAnycastInput = $("#networkIpv4RoutesAnycastInput").val();
    var networkIpv6GatewayInput = $("#networkIpv6GatewayInput").val();
    var networkIpv6RoutesAnycastInput = $("#networkIpv6RoutesAnycastInput").val();
    var networkDnsNameserversInput = $("#networkDnsNameserversInput").val();
    var networkOvnIngressModeInput = $("#networkOvnIngressModeInput").val();

    console.log("Info: creating network");
    $.get("./backend/lxd/networks.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName) + 
    "&name=" + encodeURI(networkNameInput) + 
    "&type=" + encodeURI(networkTypeInput) + 
    "&description=" + encodeURI(networkDescriptionInput) + 
    "&bridge_driver=" + encodeURI(networkBridgeDriverInput) + 
    "&bridge_external_interfaces=" + encodeURI(networkBridgeExternalInterfacesInput) + 
    "&bridge_hwaddr=" + encodeURI(networkBridgeHwaddrInput) + 
    "&bridge_mode=" + encodeURI(networkBridgeModeInput) + 
    "&bridge_mtu=" + encodeURI(networkBridgeMtuInput) + 
    "&dns_domain=" + encodeURI(networkDnsDomainInput) + 
    "&dns_mode=" + encodeURI(networkDnsModeInput) + 
    "&dns_search=" + encodeURI(networkDnsSearchInput) + 
    "&fan_overlay_subnet=" + encodeURI(networkFanOverlaySubnetInput) + 
    "&fan_type=" + encodeURI(networkFanTypeInput) + 
    "&fan_underlay_subnet=" + encodeURI(networkFanUnderlaySubnetInput) + 
    "&ipv4_address=" + encodeURI(networkIpv4AddressInput) + 
    "&ipv4_dhcp=" + encodeURI(networkIpv4DhcpInput) + 
    "&ipv4_dhcp_expiry=" + encodeURI(networkIpv4DhcpExpiryInput) + 
    "&ipv4_dhcp_gateway=" + encodeURI(networkIpv4DhcpGatewayInput) + 
    "&ipv4_dhcp_ranges=" + encodeURI(networkIpv4DhcpRangesInput) + 
    "&ipv4_firewall=" + encodeURI(networkIpv4FirewallInput) + 
    "&ipv4_nat_address=" + encodeURI(networkIpv4NatAddressInput) + 
    "&ipv4_nat=" + encodeURI(networkIpv4NatInput) + 
    "&ipv4_nat_order=" + encodeURI(networkIpv4NatOrderInput) + 
    "&ipv4_ovn_ranges=" + encodeURI(networkIpv4OvnRangesInput) + 
    "&ipv4_routes=" + encodeURI(networkIpv4RoutesInput) + 
    "&ipv4_routing=" + encodeURI(networkIpv4RoutingInput) + 
    "&ipv6_address=" + encodeURI(networkIpv6AddressInput) + 
    "&ipv6_dhcp=" + encodeURI(networkIpv6DhcpInput) + 
    "&ipv6_dhcp_expiry=" + encodeURI(networkIpv6DhcpExpiryInput) + 
    "&ipv6_dhcp_ranges=" + encodeURI(networkIpv6DhcpRangesInput) + 
    "&ipv6_dhcp_stateful=" + encodeURI(networkIpv6DhcpStatefulInput) + 
    "&ipv6_firewall=" + encodeURI(networkIpv6FirewallInput) + 
    "&ipv6_nat_address=" + encodeURI(networkIpv6NatAddressInput) + 
    "&ipv6_nat=" + encodeURI(networkIpv6NatInput) + 
    "&ipv6_nat_order=" + encodeURI(networkIpv6NatOrderInput) + 
    "&ipv6_ovn_ranges=" + encodeURI(networkIpv6OvnRangesInput) + 
    "&ipv6_routes=" + encodeURI(networkIpv6RoutesInput) + 
    "&ipv6_routing=" + encodeURI(networkIpv6RoutingInput) + 
    "&maas_subnet_ipv4=" + encodeURI(networkMaasSubnetIpv4Input) + 
    "&maas_subnet_ipv6=" + encodeURI(networkMaasSubnetIpv6Input) + 
    "&raw_dnsmasq=" + encodeURI(networkRawDnsmasqInput) + 
    "&mtu=" + encodeURI(networkMtuInput) + 
    "&parent=" + encodeURI(networkParentInput) + 
    "&vlan=" + encodeURI(networkVlanInput) + 
    "&network=" + encodeURI(networkNetworkInput) + 
    "&ipv4_gateway=" + encodeURI(networkIpv4GatewayInput) + 
    "&ipv4_routes_anycast=" + encodeURI(networkIpv4RoutesAnycastInput) + 
    "&ipv6_gateway=" + encodeURI(networkIpv6GatewayInput) + 
    "&ipv6_routes_anycast=" + encodeURI(networkIpv6RoutesAnycastInput) + 
    "&dns_nameservers=" + encodeURI(networkDnsNameserversInput) + 
    "&ovn_ingress_mode=" + encodeURI(networkOvnIngressModeInput) + 
    "&action=createNetworkUsingForm", function (data) {
      //Async type
      var operationData = JSON.parse(data);
      console.log(operationData);
      if (operationData.error_code >= 400){
        alert(operationData.error);
      }
      operationStatusCheck();
      setTimeout(() => { reloadPageContent(); }, 1000);
    });
  }

  function createNetworkUsingJSON(){
    var networkCreateJSON = $("#jsonCreateInput").val();
    console.log("Info: creating network");
    $.post("./backend/lxd/networks.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName) + "&action=createNetworkUsingJSON", {json: networkCreateJSON},  function (data) {
      //Async type
      var operationData = JSON.parse(data);
      console.log(operationData);
      if (operationData.error_code >= 400){
        alert(operationData.error);
      }
      operationStatusCheck();
      setTimeout(() => { reloadPageContent(); }, 1000);
    });
  }

  function loadNetworkJson(networkToLoad){
    console.log("Info: loading network " + networkToLoad);
    networkToUpdate = networkToLoad;
    $.get("./backend/lxd/networks.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName) + "&network=" + encodeURI(networkToLoad) + "&action=loadNetwork", function (data) {
      //Sync type
      var operationData = JSON.parse(data);
      console.log(operationData);
      if (operationData.error_code >= 400){
        alert(operationData.error);
      }
      $("#networkNameEditInput").text("Name: " + networkToLoad);
      $("#jsonEditInput").val(JSON.stringify(operationData.metadata, null, 2));
      $("#editNetworkModal").modal('show');
    });
  }

  function loadRenameNetwork(networkToRename){
    console.log("Loading rename modal for network " + networkToRename)
    $("#renameNetworkModalLabel").text("Rename network: " + networkToRename);
    $("#networkToRename").val(networkToRename);
    $("#renameNetworkModal").modal('show');
  }

  function updateNetwork(){
    var networkUpdateJSON = $("#jsonEditInput").val();
    console.log("Info: updating network " + networkToUpdate);
    $.post("./backend/lxd/networks.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName) + "&network=" + encodeURI(networkToUpdate) + "&action=updateNetwork", {json: networkUpdateJSON},  function (data) {
      //Sync type
      var operationData = JSON.parse(data);
      console.log(operationData);
      if (operationData.error_code >= 400){
        alert(operationData.error);
      }
      setTimeout(() => { reloadPageContent(); }, 1000);
    });
  }

  function renameNetwork(){
    var networkName = $("#newNetworkName").val();
    var network = $("#networkToRename").val();
    console.log("Info: renaming network " + network);
    $.get("./backend/lxd/networks.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName) + "&network=" + encodeURI(network) + "&name=" + encodeURI(networkName) + "&action=renameNetwork",  function (data) {
      //Sync operation type
      var operationData = JSON.parse(data);
      console.log(operationData);
      if (operationData.error_code >= 400){
        alert(operationData.error);
      }
      setTimeout(() => { reloadPageContent(); }, 2000);
    });
  }

  function deleteNetwork(networkToDelete){
    console.log("Info: deleting network " + networkToDelete);
    $.get("./backend/lxd/networks.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName) + "&network=" + encodeURI(networkToDelete) + "&action=deleteNetwork",  function (data) {
      //Sync type
      var operationData = JSON.parse(data);
      console.log(operationData);
      if (operationData.error_code >= 400){
        alert(operationData.error);
      }
      setTimeout(() => { reloadPageContent(); }, 1000);
    });
  }

  function loadCreateNetworkModal(){
    console.log("Info: loading create network modal");
    $("#networkParentInput").load("./backend/lxd/networks.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName) + "&action=listNetworksForSelectOption");
    $("#networkNetworkInput").load("./backend/lxd/networks.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName) + "&managed_only=true" + "&action=listNetworksForSelectOption");
    changeNetworkTypeInput();
    $("#createNetworkModal").modal('show');
  }

  function changeNetworkTypeInput(){
    var networkTypeInput = $("#networkTypeInput").val();
   
    if (networkTypeInput == "bridge"){
      $("#networkBridgeDriverRow").show()
      $("#networkBridgeExternalInterfacesRow").show()
      $("#networkBridgeHwaddrRow").show()
      $("#networkBridgeModeRow").show()
      $("#networkBridgeMtuRow").show()
      $("#networkDnsDomainRow").show()
      $("#networkDnsModeRow").show()
      $("#networkDnsSearchRow").show()
      $("#networkFanOverlaySubnetRow").show()
      $("#networkFanTypeRow").show()
      $("#networkFanUnderlaySubnetRow").show()
      $("#networkIpv4AddressRow").show()
      $("#networkIpv4DhcpRow").show()
      $("#networkIpv4DhcpExpiryRow").show()
      $("#networkIpv4DhcpGatewayRow").show()
      $("#networkIpv4DhcpRangesRow").show()
      $("#networkIpv4FirewallRow").show()
      $("#networkIpv4NatAddressRow").show()
      $("#networkIpv4NatRow").show()
      $("#networkIpv4NatOrderRow").show()
      $("#networkIpv4OvnRangesRow").show()
      $("#networkIpv4RoutesRow").show()
      $("#networkIpv4RoutingRow").show()
      $("#networkIpv6AddressRow").show()
      $("#networkIpv6DhcpRow").show()
      $("#networkIpv6DhcpExpiryRow").show()
      $("#networkIpv6DhcpRangesRow").show()
      $("#networkIpv6DhcpStatefulRow").show()
      $("#networkIpv6FirewallRow").show()
      $("#networkIpv6NatAddressRow").show()
      $("#networkIpv6NatRow").show()
      $("#networkIpv6NatOrderRow").show()
      $("#networkIpv6OvnRangesRow").show()
      $("#networkIpv6RoutesRow").show()
      $("#networkIpv6RoutingRow").show()
      $("#networkMaasSubnetIpv4Row").show()
      $("#networkMaasSubnetIpv6Row").show()
      $("#networkRawDnsmasqRow").show()
      $("#networkMtuRow").hide()
      $("#networkParentRow").hide()
      $("#networkVlanRow").hide()
      $("#networkNetworkRow").hide()
      $("#networkIpv4GatewayRow").hide()
      $("#networkIpv4RoutesAnycastRow").hide()
      $("#networkIpv6GatewayRow").hide()
      $("#networkIpv6RoutesAnycastRow").hide()
      $("#networkDnsNameserversRow").hide()
      $("#networkOvnIngressModeRow").hide()
    }
    if (networkTypeInput == "macvlan" || networkTypeInput == "sriov"){
      $("#networkBridgeDriverRow").hide()
      $("#networkBridgeExternalInterfacesRow").hide()
      $("#networkBridgeHwaddrRow").hide()
      $("#networkBridgeModeRow").hide()
      $("#networkBridgeMtuRow").hide()
      $("#networkDnsDomainRow").hide()
      $("#networkDnsModeRow").hide()
      $("#networkDnsSearchRow").hide()
      $("#networkFanOverlaySubnetRow").hide()
      $("#networkFanTypeRow").hide()
      $("#networkFanUnderlaySubnetRow").hide()
      $("#networkIpv4AddressRow").hide()
      $("#networkIpv4DhcpRow").hide()
      $("#networkIpv4DhcpExpiryRow").hide()
      $("#networkIpv4DhcpGatewayRow").hide()
      $("#networkIpv4DhcpRangesRow").hide()
      $("#networkIpv4FirewallRow").hide()
      $("#networkIpv4NatAddressRow").hide()
      $("#networkIpv4NatRow").hide()
      $("#networkIpv4NatOrderRow").hide()
      $("#networkIpv4OvnRangesRow").hide()
      $("#networkIpv4RoutesRow").hide()
      $("#networkIpv4RoutingRow").hide()
      $("#networkIpv6AddressRow").hide()
      $("#networkIpv6DhcpRow").hide()
      $("#networkIpv6DhcpExpiryRow").hide()
      $("#networkIpv6DhcpRangesRow").hide()
      $("#networkIpv6DhcpStatefulRow").hide()
      $("#networkIpv6FirewallRow").hide()
      $("#networkIpv6NatAddressRow").hide()
      $("#networkIpv6NatRow").hide()
      $("#networkIpv6NatOrderRow").hide()
      $("#networkIpv6OvnRangesRow").hide()
      $("#networkIpv6RoutesRow").hide()
      $("#networkIpv6RoutingRow").hide()
      $("#networkMaasSubnetIpv4Row").show()
      $("#networkMaasSubnetIpv6Row").show()
      $("#networkRawDnsmasqRow").hide()
      $("#networkMtuRow").show()
      $("#networkParentRow").show()
      $("#networkVlanRow").show()
      $("#networkNetworkRow").hide()
      $("#networkIpv4GatewayRow").hide()
      $("#networkIpv4RoutesAnycastRow").hide()
      $("#networkIpv6GatewayRow").hide()
      $("#networkIpv6RoutesAnycastRow").hide()
      $("#networkDnsNameserversRow").hide()
      $("#networkOvnIngressModeRow").hide()
    }
    if (networkTypeInput == "ovn"){
      $("#networkBridgeDriverRow").hide()
      $("#networkBridgeExternalInterfacesRow").hide()
      $("#networkBridgeHwaddrRow").show()
      $("#networkBridgeModeRow").hide()
      $("#networkBridgeMtuRow").show()
      $("#networkDnsDomainRow").show()
      $("#networkDnsModeRow").hide()
      $("#networkDnsSearchRow").show()
      $("#networkFanOverlaySubnetRow").hide()
      $("#networkFanTypeRow").hide()
      $("#networkFanUnderlaySubnetRow").hide()
      $("#networkIpv4AddressRow").show()
      $("#networkIpv4DhcpRow").show()
      $("#networkIpv4DhcpExpiryRow").hide()
      $("#networkIpv4DhcpGatewayRow").hide()
      $("#networkIpv4DhcpRangesRow").hide()
      $("#networkIpv4FirewallRow").hide()
      $("#networkIpv4NatAddressRow").hide()
      $("#networkIpv4NatRow").show()
      $("#networkIpv4NatOrderRow").hide()
      $("#networkIpv4OvnRangesRow").hide()
      $("#networkIpv4RoutesRow").hide()
      $("#networkIpv4RoutingRow").hide()
      $("#networkIpv6AddressRow").show()
      $("#networkIpv6DhcpRow").show()
      $("#networkIpv6DhcpExpiryRow").hide()
      $("#networkIpv6DhcpRangesRow").hide()
      $("#networkIpv6DhcpStatefulRow").show()
      $("#networkIpv6FirewallRow").hide()
      $("#networkIpv6NatAddressRow").hide()
      $("#networkIpv6NatRow").show()
      $("#networkIpv6NatOrderRow").hide()
      $("#networkIpv6OvnRangesRow").hide()
      $("#networkIpv6RoutesRow").hide()
      $("#networkIpv6RoutingRow").hide()
      $("#networkMaasSubnetIpv4Row").hide()
      $("#networkMaasSubnetIpv6Row").hide()
      $("#networkRawDnsmasqRow").hide()
      $("#networkMtuRow").hide()
      $("#networkParentRow").hide()
      $("#networkVlanRow").hide()
      $("#networkNetworkRow").show()
      $("#networkIpv4GatewayRow").hide()
      $("#networkIpv4RoutesAnycastRow").hide()
      $("#networkIpv6GatewayRow").hide()
      $("#networkIpv6RoutesAnycastRow").hide()
      $("#networkDnsNameserversRow").hide()
      $("#networkOvnIngressModeRow").hide()
    }
    if (networkTypeInput == "physical"){
      $("#networkBridgeDriverRow").hide()
      $("#networkBridgeExternalInterfacesRow").hide()
      $("#networkBridgeHwaddrRow").hide()
      $("#networkBridgeModeRow").hide()
      $("#networkBridgeMtuRow").hide()
      $("#networkDnsDomainRow").hide()
      $("#networkDnsModeRow").hide()
      $("#networkDnsSearchRow").hide()
      $("#networkFanOverlaySubnetRow").hide()
      $("#networkFanTypeRow").hide()
      $("#networkFanUnderlaySubnetRow").hide()
      $("#networkIpv4AddressRow").hide()
      $("#networkIpv4DhcpRow").hide()
      $("#networkIpv4DhcpExpiryRow").hide()
      $("#networkIpv4DhcpGatewayRow").hide()
      $("#networkIpv4DhcpRangesRow").hide()
      $("#networkIpv4FirewallRow").hide()
      $("#networkIpv4NatAddressRow").hide()
      $("#networkIpv4NatRow").hide()
      $("#networkIpv4NatOrderRow").hide()
      $("#networkIpv4OvnRangesRow").show()
      $("#networkIpv4RoutesRow").show()
      $("#networkIpv4RoutingRow").hide()
      $("#networkIpv6AddressRow").hide()
      $("#networkIpv6DhcpRow").hide()
      $("#networkIpv6DhcpExpiryRow").hide()
      $("#networkIpv6DhcpRangesRow").hide()
      $("#networkIpv6DhcpStatefulRow").hide()
      $("#networkIpv6FirewallRow").hide()
      $("#networkIpv6NatAddressRow").hide()
      $("#networkIpv6NatRow").hide()
      $("#networkIpv6NatOrderRow").hide()
      $("#networkIpv6OvnRangesRow").show()
      $("#networkIpv6RoutesRow").show()
      $("#networkIpv6RoutingRow").hide()
      $("#networkMaasSubnetIpv4Row").show()
      $("#networkMaasSubnetIpv6Row").show()
      $("#networkRawDnsmasqRow").hide()
      $("#networkMtuRow").show()
      $("#networkParentRow").show()
      $("#networkVlanRow").show()
      $("#networkNetworkRow").hide()
      $("#networkIpv4GatewayRow").show()
      $("#networkIpv4RoutesAnycastRow").show()
      $("#networkIpv6GatewayRow").show()
      $("#networkIpv6RoutesAnycastRow").show()
      $("#networkDnsNameserversRow").show()
      $("#networkOvnIngressModeRow").show()
    }
  }

  function setSidebarToggleValue(){
    sidebarState = localStorage.getItem('sidebarState');
    if (sidebarState == "collapsed"){
      localStorage.setItem('sidebarState','expanded');
    }
    else {
      localStorage.setItem('sidebarState','collapsed');
    }
  }
  
  function applySidebarToggleValue() {
    sidebarState = localStorage.getItem('sidebarState');
    if (sidebarState == "collapsed"){
      $("body").toggleClass("sidebar-toggled"), 
      $(".sidebar").toggleClass("toggled"), 
      $(".sidebar").hasClass("toggled") && $(".sidebar .collapse").collapse("hide")
    }
  }

  applySidebarToggleValue();

  $(document).ready(function(){

    //Check Authorization
    $.get("./backend/aaa/authentication.php?action=validateAuthentication", function (data) {
      operationData = JSON.parse(data);
      if (operationData.status_code != 200) {
        console.log(operationData);
        window.location.href = './index.php'
      }
    });

     //Load in the sidebar
    $("#sidebarLinks").load("./sidebar.php?version=3.0");
    
    //Setup Page Breadcrumb Links/Information
    $('#remoteBreadCrumb').load("./backend/lxd/remote-breadcrumb.php?remote=" + encodeURI(remoteId));
    $('#remoteBreadCrumb').attr("href", "remotes-single.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName));

    //Set top navbar dropdowns
    $("#remoteListNav").load("./backend/lxd/remotes.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName) + "&action=listRemotesForSelectOption");
    $("#projectListNav").load("./backend/lxd/projects.php?remote=" + encodeURI(remoteId) + "&project=" + encodeURI(projectName) + "&action=listProjectsForSelectOption");

    //Load the card contents
    loadPageContent();

    //Load the about info for the about modal
    $.get("./backend/config/about.php", function (data) {
      $("#about").html(data);
    });

  });

</script>

</html>